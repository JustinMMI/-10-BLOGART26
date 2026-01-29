<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numMemb = (int) $_POST['numMemb'];

sql_delete('COMMENT', "numMemb = $numMemb");

sql_delete('MEMBRE', "numMemb = $numMemb");

header('Location: ../../views/backend/members/list.php');


