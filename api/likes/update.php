<?php
session_start();
require_once '../../config.php';
require_once '../../functions/query/update.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin();

$numMemb = $_POST['numMemb']; 
$numArt = $_POST['numArt'];
$statut = $_POST['statut']; 


header('Location: ../../views/backend/likes/list.php');
exit();