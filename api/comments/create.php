<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/ctrlSaisies.php';

if (!isset($_SESSION['user'])) {
	header('Location: /views/backend/security/login.php');
	exit;
}

$numArt = (int) ($_POST['numArt'] ?? 0);
$libCom = addslashes(ctrlSaisies($_POST['libCom'] ?? ''));

if ($numArt <= 0 || $libCom === '') {
	header('Location: /views/backend/comments/create.php?error=1');
	exit;
}

$numMemb = (int) $_SESSION['user']['id'];

sql_insert(
	'COMMENT',
	'libCom, numArt, numMemb, dtCreaCom',
	"'$libCom', $numArt, $numMemb, NOW()"
);

$redirect = $_POST['redirect'] ?? '/';

if (!str_starts_with($redirect, '/')) {
    $redirect = '/';
}

header('Location: ' . $redirect);
exit;



