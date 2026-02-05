<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/update.php';
require_once '../../functions/query/delete.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin();

if (!isset($_SESSION['user'])) {
    header('Location: /views/backend/security/login.php');
    exit;
}

$numStat = (int)($_POST['numStat'] ?? 0);
$reassignStat = (int)($_POST['reassignStat'] ?? 0);

if ($numStat <= 0) {
    header('Location: ../../views/backend/statuts/list.php?error=' . urlencode('Statut invalide'));
    exit;
}

$currentUserId = (int)($_SESSION['user']['id'] ?? 0);
$currentUserStat = 0;
if ($currentUserId > 0) {
    $userStatRow = sql_select("MEMBRE", "numStat", "numMemb = $currentUserId");
    $currentUserStat = (int)($userStatRow[0]['numStat'] ?? 0);
}

$nbMembers = sql_select(
    "MEMBRE",
    "COUNT(*) AS total",
    "numStat = $numStat"
)[0]['total'];

if ($nbMembers > 0 && $reassignStat <= 0) {
    header('Location: ../../views/backend/statuts/delete.php?numStat=' . $numStat . '&error=' . urlencode('Des membres utilisent ce statut. Réattribuez un statut avant suppression.'));
    exit;
}

if ($reassignStat > 0) {
    if ($reassignStat == $numStat) {
        header('Location: ../../views/backend/statuts/delete.php?numStat=' . $numStat . '&error=' . urlencode('Impossible de réattribuer le même statut.'));
        exit;
    }

    // Vérifier que le statut existe
    $checkStat = sql_select("STATUT", "numStat", "numStat = $reassignStat");
    if (empty($checkStat)) {
        header('Location: ../../views/backend/statuts/delete.php?numStat=' . $numStat . '&error=' . urlencode('Statut de réattribution invalide.'));
        exit;
    }

    sql_update('MEMBRE', "numStat = $reassignStat", "numStat = $numStat");
}

sql_delete('STATUT', "numStat = $numStat");

header('Location: ../../views/backend/statuts/list.php?success=' . urlencode('Statut supprimé'));