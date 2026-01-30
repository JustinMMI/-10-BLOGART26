<?php
// 1. Session et Connexion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../../header.php';
$db = sql_connect(); // Récupération de la connexion pour le check manuel du like

// 2. Récupération de l'article
$numArt = (int) ($_GET['numArt'] ?? 0);
$article = null;

if ($numArt > 0) {
    // On récupère tout (*) pour avoir l'image et le paragraphe s'ils existent
    $article = sql_select("ARTICLE", "*", "numArt = $numArt");
    $article = $article[0] ?? null;
}

// 3. Logique du Like
$numMemb = isset($_SESSION['numMemb']) ? $_SESSION['numMemb'] : null;
$userLiked = false;

if ($article && $numMemb) {
    // Vérifie si le membre a déjà liké cet article
    $sqlCheck = "SELECT * FROM `LIKE` WHERE numMemb = '$numMemb' AND numArt = '$numArt'";
    $resultCheck = $db->query($sqlCheck);
    
    if ($resultCheck && $resultCheck->rowCount() > 0) {
        $userLiked = true;
    }
}
?>

<div class="container mt-5">
    <?php if ($article): ?>
        
        <h1><?= htmlspecialchars($article['libTitrArt']); ?></h1>
        <p class="text-muted">Publié le <?= htmlspecialchars($article['dtCreaArt']); ?></p>

        <?php if (!empty($article['urlPhotArt'])): ?>
            <div class="text-center mb-4">
                <img src="../../../src/uploads/<?= htmlspecialchars($article['urlPhotArt']); ?>" 
                     class="img-fluid rounded" 
                     alt="Image Article" 
                     style="max-height: 400px; object-fit: cover;">
            </div>
        <?php endif; ?>

        <div class="article-content mb-4">
            <p class="fw-bold lead"><?= nl2br(htmlspecialchars($article['libChapoArt'])); ?></p>
            <hr>
            <?php if (isset($article['parag1Art'])): ?>
                <p><?= nl2br(htmlspecialchars($article['parag1Art'])); ?></p>
            <?php endif; ?>
        </div>

        <div class="card bg-light mb-5">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                
                <div class="like-section">
                    <?php if ($numMemb): ?>
                        <?php if ($userLiked): ?>
                            <form action="../../../api/likes/delete.php" method="POST" style="display:inline;">
                                <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                <input type="hidden" name="frontend" value="true">
                                <button type="submit" class="btn btn-danger">
                                    ❤️ Je n'aime plus
                                </button>
                            </form>
                        <?php else: ?>
                            <form action="../../../api/likes/create.php" method="POST" style="display:inline;">
                                <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                <input type="hidden" name="frontend" value="true">
                                <button type="submit" class="btn btn-outline-danger">
                                    🤍 J'aime cet article
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="text-muted">Connectez-vous pour aimer</span>
                    <?php endif; ?>
                </div>

                <div class="comment-section">
                    <?php if ($numMemb): ?>
                        <a class="btn btn-primary" href="<?= defined('ROOT_URL') ? ROOT_URL : '../../..' ?>/views/backend/comments/create.php?numArt=<?= (int) $article['numArt']; ?>">
                            💬 Commenter cet article
                        </a>
                    <?php else: ?>
                        <a class="btn btn-secondary" href="<?= defined('ROOT_URL') ? ROOT_URL : '../../..' ?>/views/backend/security/login.php">
                            Se connecter pour commenter
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <div class="mb-5">
            <a href="../../../index.php" class="btn btn-dark">← Retour à l'accueil</a>
        </div>

    <?php else: ?>
        <div class="alert alert-warning mt-5">Oups, cet article est introuvable ou a été supprimé.</div>
        <div class="mt-3">
            <a href="../../../index.php" class="btn btn-primary">Retour à l'accueil</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../../../footer.php'; ?>