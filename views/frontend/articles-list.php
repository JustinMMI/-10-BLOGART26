<?php
require_once '../../header.php';
require_once '../../functions/query/select.php';

// Récupération de tous les articles
$articles = sql_select("ARTICLE", "*", null, null, "dtCreaArt DESC");
$db = sql_connect();
?>

<div class="container mt-4">
    <h1 class="mb-4">Tous les articles</h1>

    <?php if (!empty($articles)): ?>
        <div class="row">
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

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($article['urlPhotArt'])): ?>
                            <img src="/src/uploads/<?= htmlspecialchars($article['urlPhotArt']) ?>" class="card-img-top" alt="<?= htmlspecialchars($article['libTitrArt']) ?>" style="height: 250px; object-fit: cover;">
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <p class="text-muted small"><?= date('d F Y', strtotime($article['dtCreaArt'])) ?></p>
                            <h5 class="card-title"><?= htmlspecialchars($article['libTitrArt']) ?></h5>
                            <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($article['libChapoArt'])) ?></p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3 gap-2">
                                <a class="btn btn-primary btn-sm" href="/views/frontend/articles/article1.php?numArt=<?= (int)$article['numArt'] ?>">Lire l'article</a>

                                <!-- Bouton Like -->
                                <div class="like-container">
                                    <?php if (isset($_SESSION['user'])): ?>
                                        <?php if ($userLiked): ?>
                                            <form action="/api/likes/create.php" method="POST" class="d-inline">
                                                <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                                <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                                <input type="hidden" name="frontend" value="true">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    ❤️
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form action="/api/likes/create.php" method="POST" class="d-inline">
                                                <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                                <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                                <input type="hidden" name="frontend" value="true">
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    🤍
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="/views/backend/security/login.php" class="btn btn-outline-danger btn-sm" title="Se connecter pour liker">🤍</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Aucun article disponible.</div>
    <?php endif; ?>
</div>

<?php require_once '../../footer.php'; ?>
