<?php

function requireAdmin(string $mode = 'api'): void
{
    // Session obligatoire
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $isLogged = !empty($_SESSION['user']);
    $isStaff  = $isLogged &&
        in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur'], true);

    /*
        MODE API  → protection des fichiers /api/*
        MODE PAGE → protection des pages backend
    */

    if ($mode === 'api') {

        // Accès direct par URL (GET)
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (!$isLogged) {
                header('Location: /views/backend/security/login.php');
            } elseif (!$isStaff) {
                header('Location: /');
            } else {
                header('Location: /views/backend/dashboard.php');
            }
            exit;
        }

        // POST mais non connecté
        if (!$isLogged) {
            header('Location: /views/backend/security/login.php');
            exit;
        }

        // POST mais pas staff
        if (!$isStaff) {
            header('Location: /');
            exit;
        }

        // ✅ Autorisé
        return;
    }

    /* =========================
       MODE PAGE BACKEND
    ========================= */
    if ($mode === 'page') {

        if (!$isLogged) {
            header('Location: /views/backend/security/login.php');
            exit;
        }

        if (!$isStaff) {
            header('Location: /');
            exit;
        }

        // ✅ Autorisé
        return;
    }
}
