<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/ctrlSaisies.php';

if (
    empty($_POST['numCom']) ||
    empty($_POST['redirect'])
) {
    header('Location: /');
    exit;
}

$numCom   = (int) $_POST['numCom'];
$redirect = $_POST['redirect'];

if (!str_starts_with($redirect, '/')) {
    $redirect = '/';
}

$resultat = sql_delete('COMMENT', 'numCom = ' . $numCom);

if ($resultat === true) {
    header('Location: ' . $redirect . '?message=deleted');
} else {
    header('Location: ' . $redirect . '?message=error');
}
exit;


