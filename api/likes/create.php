<?php
require_once '../../config.php';
require_once '../../functions/query/insert.php';

$numMemb = $_POST['numMemb'];
$numArt = $_POST['numArt'];
$statut = 1;

insert("LIKE", ["numMemb", "numArt", "statut"], [$numMemb, $numArt, $statut]);

if (isset($_POST['frontend'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ../../views/backend/likes/list.php');
}
exit();