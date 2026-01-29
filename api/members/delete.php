<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$numMemb = (int) $_POST['numMemb'];
$ghostUserId = 999;

// Sécurité : empêcher suppression du ghost user
if ($numMemb === $ghostUserId) {
    header('Location: ../../views/backend/members/list.php');
    exit;
}

// Réassignation des dépendances
sql_update('LIKEART', "numMemb = $ghostUserId", "numMemb = $numMemb");
sql_update('COMMENT', "numMemb = $ghostUserId", "numMemb = $numMemb");

// Suppression du membre
sql_delete('MEMBRE', "numMemb = $numMemb");

header('Location: ../../views/backend/members/list.php');
exit;
