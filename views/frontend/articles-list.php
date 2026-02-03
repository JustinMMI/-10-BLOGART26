<?php
require_once '../../header.php';
require_once '../../functions/query/select.php';

// Récupération de tous les articles
$articles = sql_select("ARTICLE", "*", null, null, "dtCreaArt DESC");
$db = sql_connect();
?>

<link rel="stylesheet" href="/src/css/articles-list.css">

<div class="articles-page">
    <div class="articles-container">
        <h1 class="articles-title">Tous les articles</h1>

        <?php if (!empty($articles)): ?>
            <div class="articles-grid">
                <?php foreach ($articles as $article): ?>
                    <?php
                    // --- LOGIQUE LIKE POUR CHAQUE ARTICLE ---
                    $userLiked = false;
                    $numMemb = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
                    $numArt = $article['numArt'];

                    if ($numMemb) {
                        $resultCheck = sql_select("likeart", "*", "numMemb='$numMemb' AND numArt='$numArt'");
                        
                        if (!empty($resultCheck)) {
                            $userLiked = true;
                        }
                    }
                    // ----------------------------------------
                    ?>

                    <article class="article-card">
                        <?php if (!empty($article['urlPhotArt'])): ?>
                            <img src="/src/uploads/<?= htmlspecialchars($article['urlPhotArt']) ?>" 
                                alt="<?= htmlspecialchars($article['libTitrArt']) ?>"
                                class="article-card-image">
                        <?php endif; ?>
                        
                        <div class="article-card-body">
                            <span class="article-date"><?= date('d F Y', strtotime($article['dtCreaArt'])) ?></span>
                            <h2 class="article-card-title"><?= htmlspecialchars($article['libTitrArt']) ?></h2>
                            <p class="article-card-excerpt"><?= htmlspecialchars($article['libChapoArt']) ?></p>
                            
                            <div class="article-card-footer">
                                <a class="read-link" href="/views/frontend/articles/article1.php?numArt=<?= (int)$article['numArt'] ?>">
                                    Lire la suite →
                                </a>

                                <div>
                                    <?php if (isset($_SESSION['user'])): ?>
                                        <form action="/api/likes/create.php" method="POST" class="like-form">
                                            <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                            <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                            <input type="hidden" name="frontend" value="true">

                                            <button type="submit" class="like-btn <?= $userLiked ? 'liked' : '' ?>">
                                                <span class="heart">♥</span>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <a href="/views/backend/security/login.php" class="like-btn">
                                            <span class="heart">♡</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-articles">
                <p>Aucun article disponible pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../../footer.php'; ?>
