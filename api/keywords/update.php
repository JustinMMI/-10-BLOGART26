<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numMotCle = (int) $_POST['numMotCle'];

sql_update('MOTCLE', "libMotCle = '" . ctrlSaisies($_POST['libMotCle']) . "'", "numMotCle = $numMotCle");

header('Location: ../../views/backend/keywords/list.php');
exit;