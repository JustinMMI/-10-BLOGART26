<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

$numCom = intval($_POST['numCom'] ?? 0);
$validation = intval($_POST['validation'] ?? -1); 
$raison = ctrlSaisies($_POST['RaisonRefus'] ?? '');


if ($numCom <= 0 || ($validation !== 0 && $validation !== 1)) {
    die("Données manquantes ou invalides.");
}

$attmodOK = ($validation === 1) ? 1 : 0;               // 0 = en attente de contrôle, 1 = déjà contrôlé
$delLogiq = ($validation === 0) ? 1 : 0;              // 1 = refusé / supprimé logiquement, 0 = valide
$notifComKOAff = ($validation === 0) ? "'".addslashes($raison)."'" : "NULL"; 

// Transformation en chaîne SQL
$attributs = "attmodOK = $attmodOK, delLogiq = $delLogiq, notifComKOAff = $notifComKOAff";
$where = "numCom = $numCom";


sql_update('comment', $attributs, $where);

header('Location: /views/backend/comments/list.php');
exit;
