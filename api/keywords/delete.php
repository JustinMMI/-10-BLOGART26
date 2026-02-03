<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
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
