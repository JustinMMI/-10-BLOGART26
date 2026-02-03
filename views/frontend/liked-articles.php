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

<style>
    .liked-articles-container {
        padding: 20px 0;
    }

    .articles-section {
        margin-bottom: 40px;
    }

    .articles-section h3 {
        margin-bottom: 20px;
        font-size: 1.5rem;
        color: #333;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }

    .articles-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .article-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .article-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 10px;
        gap: 10px;
    }

    .article-header h4 {
        margin: 0;
        font-size: 1.1rem;
        color: #333;
        flex: 1;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .article-chapo {
        color: #666;
        font-size: 0.95rem;
        margin: 10px 0;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .article-actions .btn {
        flex: 1;
        min-width: 100px;
        padding: 8px 12px;
        font-size: 0.9rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .article-actions .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .article-actions .btn-primary:hover {
        background-color: #0056b3;
    }

    .article-actions .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .article-actions .btn-danger:hover {
        background-color: #c82333;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .empty-state p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 20px;
    }

    .auth-success {
        background-color: #d4edda;
        color: #155724;
        padding: 12px 20px;
        border-radius: 4px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    .auth-error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px 20px;
        border-radius: 4px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }
</style>

<?php require_once '../../footer.php'; ?>
