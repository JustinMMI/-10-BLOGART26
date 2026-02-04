<?php
session_start();
require_once '../../config.php';
require_once '../../functions/query/select.php';

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
sql_connect();
global $DB;

try {
    // Si on épingle cet article, dépingler les autres
    if ($action === 'pin') {
        $DB->query("UPDATE ARTICLE SET isEpingle = 0 WHERE isEpingle = 1");
        $DB->query("UPDATE ARTICLE SET isEpingle = 1 WHERE numArt = $numArt");
    } else {
        // Dépingler l'article
        $DB->query("UPDATE ARTICLE SET isEpingle = 0 WHERE numArt = $numArt");
    }
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
