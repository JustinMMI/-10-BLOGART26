<?php
session_start();
require '../../header.php';
require_once '../../config.php';
require_once '../../functions/query/insert.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/delete.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

// Suppression tous likes d'un membre
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numMemb']) && !isset($_GET['numArt'])) {
    $numMemb = (int)($_GET['numMemb'] ?? 0);
    
    if ($numMemb > 0) {
        sql_delete("LIKEART", "numMemb = $numMemb");
        header('Location: ../../views/backend/members/delete.php?numMemb=' . $numMemb . '&success=' . urlencode('Tous les likes du membre ont été supprimés'));
        exit;
    }
}

// Suppression tous likes d'un article
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numArt']) && !isset($_GET['numMemb'])) {
    $numArt = (int)($_GET['numArt'] ?? 0);

    if ($numArt > 0) {
        sql_delete("LIKEART", "numArt = $numArt");
        header('Location: ../../views/backend/articles/delete.php?numArt=' . $numArt . '&success=' . urlencode('Tous les likes de l\'article ont été supprimés'));
        exit;
    }
}

// Suppression normale
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numMemb = (int)($_POST['numMemb'] ?? 0);
    $numArt = (int)($_POST['numArt'] ?? 0);

    if ($numMemb > 0 && $numArt > 0) {
        sql_delete("LIKEART", "numMemb = $numMemb AND numArt = $numArt");

        if (isset($_POST['frontend'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ../../views/backend/likes/list.php');
        }
        exit;
    }
}

exit;
?>