<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numCom = intval($_POST['numCom'] ?? 0);
$validation = intval($_POST['validation'] ?? -1);
$raison = ctrlSaisies($_POST['RaisonRefus'] ?? '');

if (!$numCom || $validation === null) {
    die("Données manquantes.");
}


$attributs = [
    'attmodOK' => 1,
    'delLogiq' => ($validation == 0) ? 1 : 0,
    'notifComKOAff' => ($validation == 0) ? $raison : null
];

$where = "numCom = " . intval($numCom);

sql_update('comment', $attributs, $where);

header('Location: list.php');
exit;