<?php
session_start();
require_once '../../config.php';
require_once '../../functions/query/select.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/api_guard.php';

requireAdminApi();

header('Content-Type: application/json');

// Vérifier si l'utilisateur est authentifié et admin/modérateur
if (!isset($_SESSION['user']) || (!in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur']))) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$numArt = isset($_POST['numArt']) ? (int)$_POST['numArt'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if (!$numArt || !in_array($action, ['pin', 'unpin'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

// Vérifier que l'article existe
$article = sql_select("ARTICLE", "*", "numArt = $numArt");
if (empty($article)) {
    echo json_encode(['success' => false, 'message' => 'Article not found']);
    exit;
}

// Connecter à la base de données
$jsonFile = '../../functions/pinned_article.json';

try {
    // Lire le fichier JSON
    $data = json_decode(file_get_contents($jsonFile), true);
    
    // Si on épingle
    if ($action === 'pin') {
        $data['numArt'] = $numArt;
    } else {
        // Si on dépingle
        $data['numArt'] = null;
    }
    
    // Écrire le fichier JSON
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
