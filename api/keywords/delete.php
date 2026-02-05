<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/api_guard.php';

requireAdminApi();


if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

// Délier un mot-clé de tous ses articles
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numMotCle']) && isset($_GET['unlink'])) {
    $numMotCle = (int)($_GET['numMotCle'] ?? 0);

    if ($numMotCle <= 0) {
        header('Location: ../../views/backend/keywords/list.php?error=Donnée invalide');
        exit;
    }

    sql_delete('MOTCLEARTICLE', "numMotCle = $numMotCle");

    header('Location: ../../views/backend/keywords/delete.php?numMotCle=' . $numMotCle . '&success=' . urlencode('Mot-clé délié de tous les articles'));
    exit;
}

$numMotCle = (int)($_POST['numMotCle'] ?? 0);

if ($numMotCle <= 0) {
    header('Location: ../../views/backend/keywords/list.php?error=Donnée invalide');
    exit;
}

$nbLiens = sql_select(
    "MOTCLEARTICLE",
    "COUNT(*) AS total",
    "numMotCle = $numMotCle"
)[0]['total'];

if ($nbLiens > 0) {
    header(
        'Location: ../../views/backend/keywords/list.php?error=' .
        urlencode("Impossible de supprimer le mot-clé : des articles y sont encore liés")
    );
    exit;
}

sql_delete('MOTCLE', "numMotCle = $numMotCle");

header('Location: ../../views/backend/keywords/list.php?success=Mot-clé supprimé');
exit;
