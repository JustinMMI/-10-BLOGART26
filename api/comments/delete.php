<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/ctrlSaisies.php';

// Suppression tous les commentaires d'un membre
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numMemb']) && !isset($_GET['numCom'])) {
    $numMemb = (int) ($_GET['numMemb'] ?? 0);

    if ($numMemb > 0) {
        sql_delete('COMMENT', 'numMemb = ' . $numMemb);
        header('Location: /views/backend/members/delete.php?numMemb=' . $numMemb . '&success=' . urlencode('Tous les commentaires du membre ont été supprimés'));
        exit;
    }
}

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


