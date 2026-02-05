<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin();

$numMotCle = (int) $_POST['numMotCle'];

sql_update('MOTCLE', "libMotCle = '" . ctrlSaisies($_POST['libMotCle']) . "'", "numMotCle = $numMotCle");

header('Location: ../../views/backend/keywords/list.php');
exit;