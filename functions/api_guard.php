<?php
function requireAdminApi(): void
{
    // Méthode POST obligatoire
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'message' => 'Méthode non autorisée'
        ]);
        exit;
    }

    // Session requise
    if (empty($_SESSION['user'])) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Non authentifié'
        ]);
        exit;
    }

    // Rôle requis
    if (!in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur'], true)) {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'Accès refusé'
        ]);
        exit;
    }
}
