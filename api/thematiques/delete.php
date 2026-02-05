<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

// Suppression de tous les articles d'une thématique (et contenus liés)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numThem']) && isset($_GET['deleteArticles'])) {
    $numThem = (int)($_GET['numThem'] ?? 0);

    if ($numThem <= 0) {
        header('Location: ../../views/backend/thematiques/list.php?error=Donnée invalide');
        exit;
    }

    // Supprimer les likes et commentaires liés aux articles de la thématique
    sql_delete('LIKEART', "numArt IN (SELECT numArt FROM ARTICLE WHERE numThem = $numThem)");
    sql_delete('COMMENT', "numArt IN (SELECT numArt FROM ARTICLE WHERE numThem = $numThem)");

    // Supprimer les liaisons mots-clés
    sql_delete('MOTCLEARTICLE', "numArt IN (SELECT numArt FROM ARTICLE WHERE numThem = $numThem)");

    // Supprimer les articles de la thématique
    sql_delete('ARTICLE', "numThem = $numThem");

    header('Location: ../../views/backend/thematiques/delete.php?numThem=' . $numThem . '&success=' . urlencode('Tous les articles liés ont été supprimés'));
    exit;
}

$numThem = (int)($_POST['numThem'] ?? 0);

if ($numThem <= 0) {
    header('Location: ../../views/backend/thematiques/list.php?error=Donnée invalide');
    exit;
}

$nbArticles = sql_select(
    "ARTICLE",
    "COUNT(*) AS total",
    "numThem = $numThem"
)[0]['total'];

if ($nbArticles > 0) {
    header(
        'Location: ../../views/backend/thematiques/list.php?error=' .
        urlencode("Impossible de supprimer la thématique : des articles y sont encore liés")
    );
    exit;
}

sql_delete('THEMATIQUE', "numThem = $numThem");

header('Location: ../../views/backend/thematiques/list.php?success=Thématique supprimée');
exit;
