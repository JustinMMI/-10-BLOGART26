<?php
session_start();
require_once 'config.php';
cookie_wall();
cookie_notice();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bordeaux Gastronomie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/css/style.css">
</head>
<body>

<header class="header-visual">
  <div class="header-inner">

    <div class="header-left">
      <span class="header-label">BLOG GASTRONOMIQUE</span>
      <span class="header-line"></span>
    </div>

    <nav class="header-nav">
      <a href="/">Accueil</a>

      <?php if (!empty($_SESSION['user']) && $_SESSION['user']['statut'] === 'Administrateur'): ?>
        <a href="/views/backend/dashboard.php">Admin</a>
      <?php endif; ?>

      <?php if (!empty($_SESSION['user'])): ?>
        <span class="user-name"><?= htmlspecialchars($_SESSION['user']['pseudo']) ?></span>
        <a class="logout" href="/views/backend/security/login.php?action=logout">
          Déconnexion
        </a>
      <?php endif; ?>
    </nav>

  </div>
</header>
