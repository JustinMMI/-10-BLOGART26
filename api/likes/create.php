<?php

require_once '../../config.php';
require_once '../../functions/query/insert.php';

$numMemb = $_POST['numMemb'];
$numArt = $_POST['numArt'];

$statut = 1; 

header('Location: ../../views/backend/likes/list.php');
exit();