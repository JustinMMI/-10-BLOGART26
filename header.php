<?php
session_start();
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog'Art</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="src/css/style.css" />
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/x-icon" href="src/images/article1.png" />
</head>
<?php
//load config
require_once 'config.php';
?>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Blog'Art 26</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">

        <li class="nav-item">
          <a class="nav-link active" href="/">Home</a>
        </li>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['statut'] === 'Administrateur'): ?>
          <li class="nav-item">
            <a class="nav-link" href="/views/backend/dashboard.php">Admin</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>

    <!-- RIGHT SIDE -->
    <div class="d-flex align-items-center">

      <?php if (isset($_SESSION['user'])): ?>

        <span class="me-3">
          👋 <?= htmlspecialchars($_SESSION['user']['pseudo']) ?>
        </span>

        <a class="btn btn-danger"
           href="/views/backend/security/login.php?action=logout">
           Déconnexion
        </a>

      <?php else: ?>

        <a class="btn btn-primary m-1"
           href="/views/backend/security/login.php">
           Login
        </a>

        <a class="btn btn-dark m-1"
           href="/views/backend/security/signup.php">
           Sign up
        </a>

      <?php endif; ?>

    </div>
  </div>
</nav>
