<?php
require '../../header.php';
require_once '../../config.php';
require_once '../../functions/query/insert.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/delete.php';

$numMemb = $_POST['numMemb'];
$numArt = $_POST['numArt'];

sql_delete("likeart", "numMemb='$numMemb' AND numArt='$numArt'");

if (isset($_POST['frontend'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ../../views/backend/likes/list.php');
}
exit();