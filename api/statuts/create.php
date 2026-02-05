<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/api_guard.php';

requireAdminApi();

$libStat = ($_POST['libStat']);

sql_insert('STATUT', 'libStat', "'$libStat'");


header('Location: ../../views/backend/statuts/list.php');