<?php
require_once '../../header.php';

if (empty($_SESSION['user'])) {
    header('Location: ../../views/backend/security/login.php');
    exit;
}

$numMemb = $_SESSION['user']['id'];
$message = '';
$error = '';

$likedArticles = sql_select(
    "LIKEART l
     INNER JOIN ARTICLE a ON l.numArt = a.numArt",
    "l.numMemb,
     l.numArt,
     l.likeA,
     a.libTitrArt,
     a.libChapoArt,
     a.numArt",
    "l.numMemb = $numMemb AND l.likeA = 1",
    null,
    "l.numArt DESC"
);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'removeLike') {
    $numArt = (int)($_POST['numArt'] ?? 0);
    
    if ($numArt > 0) {
        sql_delete("LIKEART", "numMemb = $numMemb AND numArt = $numArt");
        $message = "Like retiré avec succès.";
        
        // Rediriger pour rafraîchir la page
        header('Location: liked-articles.php?success=1');
        exit;
    }
}

if (isset($_GET['success'])) {
    $message = "Like retiré avec succès.";
}
?>

<main class="liked-page">

  <link rel="stylesheet" href="/src/css/liked-articles.css">

  <section class="liked-hero">
    <h1>Mes coups de cœur</h1>
    <span class="liked-separator"></span>
    <p>Les articles que vous avez choisis de garder en mémoire</p>
  </section>

  <section class="liked-timeline container">

    <?php if (!empty($likedArticles)): ?>
      <div class="timeline">

        <?php foreach ($likedArticles as $article): ?>
          <article class="timeline-item">

            <div class="timeline-marker">
              ♥
            </div>

            <div class="timeline-content">
              <h2><?= htmlspecialchars($article['libTitrArt']) ?></h2>

              <p><?= htmlspecialchars($article['libChapoArt']) ?></p>

              <div class="timeline-actions">
                <a href="/views/frontend/articles/article1.php?numArt=<?= $article['numArt'] ?>">
                  Lire l’article →
                </a>

                <form method="POST">
                  <input type="hidden" name="action" value="removeLike">
                  <input type="hidden" name="numArt" value="<?= $article['numArt'] ?>">
                  <button type="submit">
                    Retirer le like
                  </button>
                </form>
              </div>
            </div>

          </article>
        <?php endforeach; ?>

      </div>
    <?php else: ?>
      <div class="liked-empty">
        <p>Vous n’avez encore aimé aucun article.</p>
        <a href="/views/frontend/articles-list.php">Découvrir les articles →</a>
      </div>
    <?php endif; ?>

  </section>
</main>



<?php require_once '../../footer.php'; ?>
