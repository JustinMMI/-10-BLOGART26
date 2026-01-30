<?php
// On appelle le header (qui démarre la session)
require_once '../../../header.php';

// Connexion BDD
$db = sql_connect();

// Récupération de l'article
$numArt = (int) ($_GET['numArt'] ?? 0);
$article = null;

if ($numArt > 0) {
    // On récupère l'article via ta fonction select
    $data = sql_select("ARTICLE", "*", "numArt = $numArt");
    $article = $data[0] ?? null;
}

// Logique Like
$numMemb = $_SESSION['numMemb'] ?? null;
$userLiked = false;

if ($article && $numMemb && $db) {
    $sqlCheck = "SELECT * FROM `LIKE` WHERE numMemb = '$numMemb' AND numArt = '$numArt'";
    $resultCheck = $db->query($sqlCheck);
    if ($resultCheck && $resultCheck->rowCount() > 0) {
        $userLiked = true;
    }
}
?>

<div class="container mt-4">
    <?php if ($article): ?>
        <h1><?= htmlspecialchars($article['libTitrArt']); ?></h1>
        <p class="text-muted">Publié le <?= htmlspecialchars($article['dtCreaArt']); ?></p>

        <?php if (!empty($article['urlPhotArt'])): ?>
            <img src="../../../src/uploads/<?= htmlspecialchars($article['urlPhotArt']); ?>" class="img-fluid mb-4 rounded" alt="Image Article" style="max-height: 400px; object-fit: cover;">
        <?php endif; ?>

        <div class="content mb-4">
            <p class="lead fw-bold"><?= nl2br(htmlspecialchars($article['libChapoArt'])); ?></p>
            <hr>
            <?php if (isset($article['parag1Art'])): ?>
                <p><?= nl2br(htmlspecialchars($article['parag1Art'])); ?></p>
            <?php endif; ?>
        </div>

        <div class="card bg-light p-3 mb-5">
            <div class="d-flex justify-content-between align-items-center">
                
                <div>
                    <?php if ($numMemb): ?>
                        <?php if ($userLiked): ?>
                            <form action="../../../api/likes/delete.php" method="POST" style="display:inline;">
                                <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                <input type="hidden" name="frontend" value="true">
                                <button type="submit" class="btn btn-danger">❤️ Je n'aime plus</button>
                            </form>
                        <?php else: ?>
                            <form action="../../../api/likes/create.php" method="POST" style="display:inline;">
                                <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                <input type="hidden" name="frontend" value="true">
                                <button type="submit" class="btn btn-outline-danger">🤍 J'aime cet article</button>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <span><a href="../../security/login.php">Connectez-vous</a> pour aimer cet article</span>
                    <?php endif; ?>
                </div>

                <div>
                    <?php if (isset($_SESSION['numMemb'])): ?>
                        <a class="btn btn-primary" href="<?= defined('ROOT_URL') ? ROOT_URL : '../../..' ?>/views/backend/comments/create.php?numArt=<?= (int) $article['numArt']; ?>">
                            💬 Commenter
                        </a>
                    <?php else: ?>
                        <a class="btn btn-secondary" href="<?= defined('ROOT_URL') ? ROOT_URL : '../../..' ?>/views/backend/security/login.php">
                            Se connecter pour commenter
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <a href="../../../index.php" class="btn btn-dark">← Retour à l'accueil</a>

    <?php else: ?>
        <div class="alert alert-warning">Article introuvable.</div>
    <?php endif; ?>
</div>

<?php require_once '../../../footer.php'; ?>