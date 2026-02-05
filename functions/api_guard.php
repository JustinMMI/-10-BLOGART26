<?php
// functions/api_guard.php

function requireAdminApi(): void
{
    // Méthode POST obligatoire
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /views/backend/dashboard.php');
        exit;
    }

    // Session obligatoire
    if (empty($_SESSION['user'])) {
        header('Location: /views/backend/security/login.php');
        exit;
    }

    // Rôle autorisé
    if (!in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur'], true)) {
        header('Location: /views/backend/dashboard.php');
        exit;
    }
}
