<?php
function requireAdmin(): void
{
    // 🔐 Session obligatoire
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // ❌ Accès direct par URL (GET)
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // Admin → dashboard
        if (!empty($_SESSION['user']) &&
            in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur'], true)
        ) {
            header('Location: /views/backend/dashboard.php');
        }
        // Non connecté → login
        elseif (empty($_SESSION['user'])) {
            header('Location: /views/backend/security/login.php');
        }
        // Connecté mais pas staff → accueil
        else {
            header('Location: /');
        }
        exit;
    }

    // ❌ Non connecté
    if (empty($_SESSION['user'])) {
        header('Location: /views/backend/security/login.php');
        exit;
    }

    // ❌ Connecté mais pas admin/modérateur
    if (!in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur'], true)) {
        header('Location: /');
        exit;
    }
}
