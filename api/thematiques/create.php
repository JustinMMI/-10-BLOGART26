<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

$libThem = ctrlSaisies($_POST['libThem']);

sql_insert('THEMATIQUE', 'libThem', "'$libThem'");

header('Location: ../../views/backend/thematiques/list.php');
exit;