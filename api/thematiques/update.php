<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin();

$numThem = (int) $_POST['numThem'];

sql_update('THEMATIQUE', "libThem = '" . ctrlSaisies($_POST['libThem']) . "'", "numThem = $numThem");

header('Location: ../../views/backend/thematiques/list.php');
exit;
