<?php

require_once '../../config.php';
require_once '../../functions/query/update.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/api_guard.php';

requireAdminApi();

$numMemb = $_POST['numMemb']; 
$numArt = $_POST['numArt'];
$statut = $_POST['statut']; 


header('Location: ../../views/backend/likes/list.php');
exit();