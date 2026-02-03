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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="/src/css/style.css">
</head>
<body>

<header class="header-visual">
  <div class="header-inner">

    <div class="header-left">
      <a class="header-label" href="/">BLOG GASTRONOMIQUE</a>
      <span class="header-line"></span>
    </div>

    <nav class="header-nav">

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
