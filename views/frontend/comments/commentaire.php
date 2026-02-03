<?php 
include '../../../header.php';

if (!isset($_SESSION['user'])) {
    header('Location: /views/backend/security/login.php');
    exit;
}

$numArt = (int) ($_GET['numArt'] ?? 0);
if ($numArt <= 0) {
    header('Location: /');
    exit;
}

$article = sql_select("ARTICLE", "numArt, libTitrArt", "numArt = $numArt");
$article = $article[0] ?? null;

if (!$article) {
    header('Location: /');
    exit;
}

$error = isset($_GET['error']) ? "Veuillez saisir un commentaire." : '';
?>

<link rel="stylesheet" href="/src/css/commentaire.css">

<main class="comment-page">
  <div class="comment-container">

    <a class="back-link"
       href="/views/frontend/articles/article1.php?numArt=<?= (int)$article['numArt']; ?>">
       ← Retour à l’article
    </a>

    <section class="comment-card">

      <header class="comment-header">
        <h1>Ajouter un commentaire</h1>
        <p class="comment-user">
          Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user']['pseudo']); ?></strong>
        </p>
      </header>

      <?php if ($error): ?>
        <div class="comment-error"><?= htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <form action="<?= ROOT_URL . '/api/comments/create.php'; ?>" method="post" class="comment-form">

        <input type="hidden" name="numArt" value="<?= (int)$article['numArt']; ?>">
        <input type="hidden" name="redirect"
               value="/views/frontend/articles/article1.php?numArt=<?= (int)$article['numArt']; ?>">

        <div class="field">
          <label>Article concerné</label>
          <input type="text"
                 value="<?= htmlspecialchars($article['libTitrArt']); ?>"
                 readonly>
        </div>

        <div class="field">
          <label for="libCom">Votre commentaire</label>
          <textarea id="libCom"
                    name="libCom"
                    rows="6"
                    required
                    placeholder="Exprimez votre avis, partagez votre expérience…"></textarea>

          <div class="bbcode-hint">
            BBCode autorisé :
            <code>[b]</code>, <code>[i]</code>, <code>[u]</code>,
            <code>[url]</code>, :) :D
          </div>
        </div>

        <div class="comment-actions">
          <button type="submit" class="btn-primary">
            Publier le commentaire
          </button>

          <a class="btn-secondary"
             href="/views/frontend/articles/article1.php?numArt=<?= (int)$article['numArt']; ?>">
             Annuler
          </a>
        </div>

      </form>

    </section>
  </div>
</main>

<?php include '../../../footer.php'; ?>
