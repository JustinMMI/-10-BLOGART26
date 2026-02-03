<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
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
