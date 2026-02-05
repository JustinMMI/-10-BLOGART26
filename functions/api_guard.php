<?php
function requireAdminApi(): void
{
    $isAjax = (
        isset($_SERVER['HTTP_ACCEPT']) &&
        str_contains($_SERVER['HTTP_ACCEPT'], 'application/json')
    );

    // Méthode POST obligatoire
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        if ($isAjax) {
            http_response_code(405);
            echo json_encode([
                'success' => false,
                'message' => 'Méthode non autorisée'
            ]);
        } else {
            header('Location: /views/backend/dashboard.php');
        }
        exit;
    }

    // Session requise
    if (empty($_SESSION['user'])) {
        if ($isAjax) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Non authentifié'
            ]);
        } else {
            header('Location: /views/backend/security/login.php');
        }
        exit;
    }

    // Rôle requis
    if (!in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur'], true)) {
        if ($isAjax) {
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'message' => 'Accès refusé'
            ]);
        } else {
            header('Location: /views/backend/dashboard.php');
        }
        exit;
    }
}
