<?php
session_start();
require '../../header.php';
require_once '../../config.php';
require_once '../../functions/query/insert.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/delete.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

$numMemb = $_SESSION['user']['id'] ?? $_POST['numMemb'];
$numArt = $_POST['numArt'];
$statut = 1;

// Vérifier si le like existe déjà
$existingLike = sql_select("likeart", "*", "numMemb='$numMemb' AND numArt='$numArt'");

if (!empty($existingLike)) {
    sql_delete("likeart", "numMemb='$numMemb' AND numArt='$numArt'");
} else {
    sql_insert("likeart", "numMemb, numArt, likeA", "'$numMemb', '$numArt', '$statut'");
}

if (isset($_POST['frontend'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ../../views/backend/likes/list.php');
}
exit();