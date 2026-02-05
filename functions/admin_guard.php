<?php

function requireAdmin(string $mode = 'api'): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $isLogged = !empty($_SESSION['user']);
    $isStaff  = $isLogged &&
        in_array($_SESSION['user']['statut'], ['Administrateur', 'Modérateur'], true);

    if ($mode === 'api') {

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

        if (!$isLogged) {
            header('Location: /views/backend/security/login.php');
            exit;
        }

        if (!$isStaff) {
            header('Location: /');
            exit;
        }

        return;
    }

    if ($mode === 'page') {

        if (!$isLogged) {
            header('Location: /views/backend/security/login.php');
            exit;
        }

        if (!$isStaff) {
            header('Location: /');
            exit;
        }

        return;
    }
}
