<?php
require_once '../../../header.php';

$numArt = (int) ($_GET['numArt'] ?? 0);
$article = null;

if ($numArt > 0) {
    $article = sql_select(
        "ARTICLE",
        "numArt, libTitrArt, libChapoArt, dtCreaArt",
        "numArt = $numArt"
    );
    $article = $article[0] ?? null;
}

$userLiked = false;
$numMemb = $_SESSION['user']['id'] ?? null;

if ($numMemb && $article) {
    $resultCheck = sql_select(
        "likeart",
        "*",
        "numMemb = $numMemb AND numArt = $numArt"
    );

    if (!empty($resultCheck)) {
        $userLiked = true;
    }
}
?>

<div class="container mt-4">

<?php if ($article): ?>

    <h1><?= htmlspecialchars($article['libTitrArt']); ?></h1>
    <p class="text-muted">Publié le <?= htmlspecialchars($article['dtCreaArt']); ?></p>
    <p><?= nl2br(htmlspecialchars($article['libChapoArt'])); ?></p>

    <div class="d-flex gap-2 mb-3">

        <?php if (isset($_SESSION['user'])): ?>
            <a class="btn btn-primary"
               href="<?= ROOT_URL ?>/views/frontend/comments/commentaire.php?numArt=<?= $article['numArt']; ?>">
                Commenter cet article
            </a>
			<a class="btn btn-primary"
               href="<?= ROOT_URL ?>/views/frontend/comments/commentaire.php?numArt=<?= $article['numArt']; ?>">
                Voir plus d'articles
            </a>

        <?php else: ?>
            <a class="btn btn-outline-primary"
               href="<?= ROOT_URL ?>/views/backend/security/login.php">
                Se connecter pour commenter
ù
            </a>
        <?php endif; ?>

        <div class="like-container">

        <?php if (isset($_SESSION['user'])): ?>

            <?php if ($userLiked): ?>
                <form action="<?= ROOT_URL ?>/api/likes/create.php" method="POST">
                    <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                    <input type="hidden" name="numArt" value="<?= $numArt ?>">
                    <input type="hidden" name="frontend" value="true">
                    <button type="submit" class="btn btn-danger btn-sm">
                        ❤️ Je n'aime plus
                    </button>
                </form>
            <?php else: ?>
                <form action="<?= ROOT_URL ?>/api/likes/create.php" method="POST">
                    <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                    <input type="hidden" name="numArt" value="<?= $numArt ?>">
                    <input type="hidden" name="frontend" value="true">
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        🤍 J'aime
                    </button>
                </form>
            <?php endif; ?>

        <?php else: ?>
            <small class="text-muted">
                <a href="<?= ROOT_URL ?>/views/backend/security/login.php">Se connecter</a> pour liker
            </small>
        <?php endif; ?>

        </div>
    </div>

    <hr>
    <h4>Commentaires</h4>

    <?php
    $commentairesArt = sql_select("COMMENT","*","numArt = $numArt");

    if (!empty($commentairesArt)):
        foreach ($commentairesArt as $commentaire):

            $membre = sql_select("MEMBRE","pseudoMemb","numMemb = " . (int)$commentaire['numMemb']);

            $pseudo = $membre[0]['pseudoMemb'] ?? 'Utilisateur supprimé';
    ?>
            <div class="border rounded p-3 mb-3">
                <strong><?= htmlspecialchars($pseudo); ?></strong><br>

                <small class="text-muted">
                    <?= htmlspecialchars($commentaire['dtCreaCom']); ?>
                </small>

                <p class="mt-2">
                    <?= nl2br(htmlspecialchars($commentaire['libCom'])); ?>
                </p>
            </div>
    <?php
        endforeach;
    else:
    ?>
        <p class="text-muted">Aucun commentaire pour cet article.</p>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning">Article introuvable.</div>
<?php endif; ?>

</div>

<?php require_once '../../../footer.php'; ?>
