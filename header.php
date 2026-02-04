<script src="https://www.google.com/recaptcha/api.js?render=6LewKl8sAAAAAApTAS7X8kAdof0A4yzZlIq9BoAb"></script>


<?php
session_start();
require_once 'config.php';
cookie_wall();
cookie_notice();
?>

<?php
$uri = $_SERVER['REQUEST_URI'];

$isBackend = str_starts_with($uri, '/views/backend/');
$isAuthPage =
    str_contains($uri, '/security/login.php') ||
    str_contains($uri, '/security/signup.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bordeaux Gastronomie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/src/css/header.css">
  <link rel="stylesheet" href="/src/css/footer.css">

  <?php if ($isBackend && !$isAuthPage): ?>
    <!-- BACKEND -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <?php else: ?>
    <!-- FRONT + LOGIN / SIGNUP -->
    <link rel="stylesheet" href="/src/css/home.css">
  <?php endif; ?>
</head>
<body>

<header class="header-visual">
  <div class="header-inner">

    <div class="header-left">
      <a class="header-label" href="/">BLOG GASTRONOMIQUE</a>
      <span class="header-line"></span>
    </div>

    <nav class="header-nav">
      <a href="/">Accueil</a>
      <a href="/views/frontend/articles-list.php">Tous les articles</a>

      <?php if (!empty($_SESSION['user'])): ?>
        <a href="/views/frontend/liked-articles.php">Mes articles likés</a>
      <?php endif; ?>

      <?php if (!empty($_SESSION['user'])): ?>
        <a href="/views/frontend/profile.php" class="user-name"><?= htmlspecialchars($_SESSION['user']['pseudo']) ?></a>
        <a class="logout" href="/views/backend/security/login.php?action=logout">
          Déconnexion
        </a>
      <?php else: ?>
        <a class="login" href="/views/backend/security/login.php">
          Connexion
        </a>
      <?php endif; ?>

      <?php if (
          !empty($_SESSION['user']) 
          && (
              $_SESSION['user']['statut'] === 'Administrateur'
              || $_SESSION['user']['statut'] === 'Modérateur'
          )
      ): ?>
          <a href="/views/backend/articles/create.php">Créer un article</a>
          <a href="/views/backend/dashboard.php">Admin</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
