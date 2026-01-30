<?php

require_once '../../config.php';
require_once '../../functions/query/delete.php';

$numMemb = $_POST['numMemb'];
$numArt = $_POST['numArt'];

header('Location: ../../views/backend/likes/list.php');
exit();