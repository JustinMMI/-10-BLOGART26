<?php
session_start();
require_once '../../config.php';
require_once '../../functions/query/select.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/api_guard.php';

requireAdminApi();

header('Content-Type: application/json');

// Vérif permissions
if (!isset($_SESSION['user']) || (!in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur']))) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if (isset($_POST['numArt'])) {
    $numArt = (int) $_POST['numArt'];
} else {
    $numArt = 0;
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}


if (!$numArt || !in_array($action, ['pin', 'unpin'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

// Vérif article existe
$article = sql_select("ARTICLE", "*", "numArt = $numArt");
if (empty($article)) {
    echo json_encode(['success' => false, 'message' => 'Article not found']);
    exit;
}

$jsonFile = '../../functions/pinned_article.json';

if (file_exists($jsonFile)) {
    $data = json_decode(file_get_contents($jsonFile), true);
} else {
    $data = ['numArt' => null];
}

if ($action === 'pin') {
    $data['numArt'] = $numArt;
} else {
    $data['numArt'] = null;
}

// dans json
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header('Location: ' . $_SERVER['HTTP_REFERER'] . '#articles');
exit;
?>
