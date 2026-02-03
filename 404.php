<?php
http_response_code(404);
require_once __DIR__ . '/header.php';
?>

<link rel="stylesheet" href="/src/css/404.css">

<main class="not-found">
    <section class="not-found__card">
        <div class="not-found__code">404</div>
        <h1 class="not-found__title">Page introuvable</h1>
        <p class="not-found__text">
            La page que vous cherchez n’existe pas ou a été déplacée.
        </p>
        <div class="not-found__actions">
            <a href="/" class="btn btn-primary">Retour à l’accueil</a>
            <a href="/views/frontend/search.php" class="btn btn-outline">Rechercher</a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/footer.php'; ?>
