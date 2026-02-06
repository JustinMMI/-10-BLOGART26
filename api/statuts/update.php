<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

$numStat = (int)($_POST['numStat'] ?? 0);
$libStat = trim($_POST['libStat'] ?? '');

if ($numStat <= 0 || $libStat === '') {
    header('Location: ../../views/backend/statuts/list.php?error=Données invalides');
    exit;
}

sql_update(
    'STATUT',
    "libStat = '$libStat'",
    "numStat = $numStat"
);

header('Location: ../../views/backend/statuts/list.php?success=Statut modifié');
exit;
