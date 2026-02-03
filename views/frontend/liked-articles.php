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

<main class="auth-page">
    <section class="auth-card">
        <h2 class="auth-title">Mes articles likés</h2>

        <?php if ($message): ?>
            <div class="auth-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="auth-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="liked-articles-container">
            <?php if (!empty($likedArticles)): ?>
                
                <?php if (!empty($likedArticles)): ?>
                    <div class="articles-section">
                        <h3>Articles aimés</h3>
                        <div class="articles-list">
                            <?php foreach ($likedArticles as $article): ?>
                                <div class="article-card">
                                    <div class="article-header">
                                        <h4><?= htmlspecialchars($article['libTitrArt']) ?></h4>
                                    </div>
                                    <p class="article-chapo"><?= htmlspecialchars($article['libChapoArt']) ?></p>
                                    <div class="article-actions">
                                        <a href="/views/frontend/articles/article1.php?numArt=<?= $article['numArt'] ?>" class="btn btn-primary">Lire l'article</a>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="removeLike">
                                            <input type="hidden" name="numArt" value="<?= $article['numArt'] ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir retirer ce like ?');">Retirer mon like</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($dislikedArticles)): ?>
                    <div class="articles-section">
                        <h3>Articles non aimés</h3>
                        <div class="articles-list">
                            <?php foreach ($dislikedArticles as $article): ?>
                                <div class="article-card">
                                    <div class="article-header">
                                        <h4><?= htmlspecialchars($article['libTitrArt']) ?></h4>
                                        <span class="badge badge-danger">👎 Non aimé</span>
                                    </div>
                                    <p class="article-chapo"><?= htmlspecialchars($article['libChapoArt']) ?></p>
                                    <div class="article-actions">
                                        <a href="/views/frontend/articles/article1.php?numArt=<?= $article['numArt'] ?>" class="btn btn-primary">Lire l'article</a>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="removeLike">
                                            <input type="hidden" name="numArt" value="<?= $article['numArt'] ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir retirer ce vote ?');">Retirer mon vote</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="empty-state">
                    <p>Vous n'avez encore aimé aucun article.</p>
                    <a href="articles-list.php" class="btn btn-primary">Découvrir les articles</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once '../../footer.php'; ?>
