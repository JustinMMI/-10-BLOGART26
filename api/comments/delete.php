<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/api_guard.php';

requireAdminApi();

// Suppression tous les commentaires d'un membre
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numMemb']) && !isset($_GET['numCom'])) {
    $numMemb = (int) ($_GET['numMemb'] ?? 0);

    if ($numMemb > 0) {
        sql_delete('COMMENT', 'numMemb = ' . $numMemb);
        header('Location: /views/backend/members/delete.php?numMemb=' . $numMemb . '&success=' . urlencode('Tous les commentaires du membre ont été supprimés'));
        exit;
    }
}

// Suppression tous les commentaires d'un article
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numArt']) && !isset($_GET['numCom'])) {
    $numArt = (int) ($_GET['numArt'] ?? 0);

    if ($numArt > 0) {
        sql_delete('COMMENT', 'numArt = ' . $numArt);
        header('Location: /views/backend/articles/delete.php?numArt=' . $numArt . '&success=' . urlencode('Tous les commentaires de l\'article ont été supprimés'));
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


