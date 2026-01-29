<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libStat = ($_POST['libstat']);
$numStat = ($_POST['numstat']);

sql_update('STATUT',"libstat= '$libStat'","numStat = $numStat" );


header('Location: ../../views/backend/statuts/list.php');
