<?php
require_once '../../../header.php';

$numArt = (int)($_GET['numArt'] ?? 0);
$article = null;

if ($numArt > 0) {
    $article = sql_select("ARTICLE", "numArt, libTitrArt, libChapoArt, dtCreaArt", "numArt = $numArt");
    $article = $article[0] ?? null;
}

$userLiked = false;
$numMemb = $_SESSION['user']['id'] ?? null;

if ($numMemb && $article) {
    $resultCheck = sql_select("LIKEART", "*", "numMemb = $numMemb AND numArt = $numArt");
    $userLiked = !empty($resultCheck);
}

$commentairesArt = [];
if ($article) {
    $commentairesArt = sql_select("COMMENT", "*", "numArt = $numArt", null, "dtCreaCom DESC");
}
?>

<link rel="stylesheet" href="/src/css/article1.css">

<main class="article-page">
  <div class="article-container">

    <a class="back-link" href="<?= ROOT_URL ?>/views/frontend/articles-list.php">← Retour aux articles</a>

    <?php if ($article): ?>

      <section class="article-layout">

        <article class="article-main">
          <div class="article-top">
            <div>
              <h1 class="article-title"><?= htmlspecialchars($article['libTitrArt']); ?></h1>
              <div class="article-meta">
                Publié le <?= htmlspecialchars(date('d/m/Y', strtotime($article['dtCreaArt']))); ?>
              </div>
            </div>

            <div class="article-actions">
              <?php if (!empty($_SESSION['user'])): ?>
                <a class="action-btn" href="<?= ROOT_URL ?>/views/frontend/comments/commentaire.php?numArt=<?= (int)$article['numArt']; ?>">
                  Commenter
                </a>
              <?php else: ?>
                <a class="action-btn ghost" href="<?= ROOT_URL ?>/views/backend/security/login.php">
                  Se connecter pour commenter
                </a>
              <?php endif; ?>

              <?php if (!empty($_SESSION['user'])): ?>
                <form action="<?= ROOT_URL ?>/api/likes/create.php" method="POST" class="like-form">
                  <input type="hidden" name="numMemb" value="<?= (int)$numMemb ?>">
                  <input type="hidden" name="numArt" value="<?= (int)$numArt ?>">
                  <input type="hidden" name="frontend" value="true">
                  <button type="submit" class="like-btn <?= $userLiked ? 'liked' : '' ?>" title="<?= $userLiked ? "Retirer le like" : "Liker" ?>">
                    <span class="heart"><?= $userLiked ? '♥' : '♡' ?></span>
                  </button>
                </form>
              <?php else: ?>
                <a class="like-btn ghost" href="<?= ROOT_URL ?>/views/backend/security/login.php" title="Se connecter pour liker">
                  <span class="heart">♡</span>
                </a>
              <?php endif; ?>
            </div>
          </div>

          <p class="article-chapo"><?= nl2br(htmlspecialchars($article['libChapoArt'])); ?></p>

          <div class="article-divider"></div>

          <a class="more-link" href="<?= ROOT_URL ?>/views/frontend/articles-list.php">
            Voir plus d’articles →
          </a>
        </article>

        <aside class="comments-panel">
          <div class="comments-head">
            <h2>Commentaires</h2>
            <span class="comments-count"><?= count($commentairesArt) ?></span>
          </div>

          <?php if (!empty($commentairesArt)): ?>
            <div class="comments-list">
              <?php foreach ($commentairesArt as $commentaire): ?>
                <?php
                  $membre = sql_select("MEMBRE", "pseudoMemb", "numMemb = " . (int)$commentaire['numMemb']);
                  $pseudo = $membre[0]['pseudoMemb'] ?? 'Utilisateur supprimé';
                ?>
                <div class="comment">
                  <div class="comment-head">
                    <strong class="comment-user"><?= htmlspecialchars($pseudo); ?></strong>
                    <span class="comment-date"><?= htmlspecialchars(date('d/m/Y H:i', strtotime($commentaire['dtCreaCom']))); ?></span>
                  </div>
                  <p class="comment-text"><?= nl2br(htmlspecialchars($commentaire['libCom'])); ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="comments-empty">Aucun commentaire pour cet article.</p>
          <?php endif; ?>

        </aside>

      </section>

    <?php else: ?>
      <div class="article-notfound">Article introuvable.</div>
    <?php endif; ?>

  </div>
</main>

<?php require_once '../../../footer.php'; ?>
