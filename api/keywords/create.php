<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin();

$libMotCle = ctrlSaisies($_POST['libMotCle']);

sql_insert('MOTCLE', 'libMotCle', "'$libMotCle'");
header('Location: ../../views/backend/keywords/list.php');
exit;