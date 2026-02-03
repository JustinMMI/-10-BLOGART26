<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numCom = $_POST['numCom'] ?? null;
$validation = $_POST['validation'] ?? null; // 1 = valider, 0 = refuser
$raison = $_POST['RaisonRefus'] ?? null;

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