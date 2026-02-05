<?php
include '../../../header.php';

// 🔐 Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

if (!isset($_GET['numArt'])) {
    header('Location: list.php');
    exit;
}

$numArt = (int) $_GET['numArt'];

// Article + thématique
$article = sql_select(
    "ARTICLE a INNER JOIN THEMATIQUE t ON a.numThem = t.numThem",
    "a.*, t.libThem",
    "a.numArt = $numArt"
)[0];

// Tous les mots-clés
$allMots = sql_select("MOTCLE", "*");

// Mots-clés liés à l’article
$motsArticle = sql_select(
    "MOTCLEARTICLE ma INNER JOIN MOTCLE mc ON ma.numMotCle = mc.numMotCle",
    "mc.numMotCle, mc.libMotCle",
    "ma.numArt = $numArt"
);

$idsMotsArticle = array_column($motsArticle, 'numMotCle');

// Commentaires
$nbComments = sql_select(
    "COMMENT",
    "COUNT(*) AS total",
    "numArt = $numArt"
)[0]['total'];

// Likes
$nbLikes = sql_select(
    "LIKEART",
    "COUNT(*) AS total",
    "numArt = $numArt"
)[0]['total'];
?>

<div class="container">
    <h1>Suppression Article</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <form action="<?= ROOT_URL . '/api/articles/delete.php'; ?>" method="post">

        <input type="hidden" name="numArt" value="<?= $numArt ?>">

        <label>Numéro</label>
        <input class="form-control mb-2" value="<?= $article['numArt'] ?>" readonly>

        <label>Titre</label>
        <input class="form-control mb-2"
               value="<?= htmlspecialchars($article['libTitrArt']); ?>" readonly>

        <label>Date création</label>
        <input class="form-control mb-2"
               value="<?= $article['dtCreaArt'] ?>" readonly>

        <label>Chapeau</label>
        <textarea class="form-control mb-3" rows="4" readonly><?= htmlspecialchars($article['libChapoArt']); ?></textarea>

        <label>Accroche paragraphe 1</label>
        <input class="form-control mb-2"
               value="<?= htmlspecialchars($article['libAccrochArt']); ?>" readonly>

        <label>Paragraphe 1</label>
        <textarea class="form-control mb-3" rows="6" readonly><?= htmlspecialchars($article['parag1Art']); ?></textarea>

        <label>Sous-titre 1</label>
        <input class="form-control mb-2"
               value="<?= htmlspecialchars($article['libSsTitr1Art']); ?>" readonly>

        <label>Paragraphe 2</label>
        <textarea class="form-control mb-3" rows="6" readonly><?= htmlspecialchars($article['parag2Art']); ?></textarea>

        <label>Sous-titre 2</label>
        <input class="form-control mb-2"
               value="<?= htmlspecialchars($article['libSsTitr2Art']); ?>" readonly>

        <label>Paragraphe 3</label>
        <textarea class="form-control mb-3" rows="6" readonly><?= htmlspecialchars($article['parag3Art']); ?></textarea>

        <label>Conclusion</label>
        <textarea class="form-control mb-4" rows="4" readonly><?= htmlspecialchars($article['libConclArt']); ?></textarea>

        <!-- IMAGE -->
        <label>Importez l'illustration</label>
        <input type="file" class="form-control mb-2" disabled>
        
        <div class="mb-4">
            <p class="fw-bold">Image actuelle :</p>
            <img src="<?= ROOT_URL . '/src/uploads/' . $article['urlPhotArt']; ?>"
                class="img-fluid d-block"
                style="max-width:600px">
        </div>

        <div class="mb-4">
            <label class="fw-bold">Thématique :</label>
            <input class="form-control"
                value="<?= htmlspecialchars($article['libThem']); ?>" readonly>
        </div>


        <label>Choisissez les mots clés liés à l'article :</label>

        <div class="row mb-3">
            <div class="col-md-5">
                <label>Liste Mots clés</label>
                <select class="form-control" size="6" disabled>
                    <?php foreach ($allMots as $mot): ?>
                        <?php if (!in_array($mot['numMotCle'], $idsMotsArticle)): ?>
                            <option><?= htmlspecialchars($mot['libMotCle']); ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2 text-center align-self-center">
                <button class="btn btn-secondary mb-2" disabled>Ajoutez &gt;&gt;</button>
                <br>
                <button class="btn btn-secondary" disabled>&lt;&lt; Supprimez</button>
            </div>

            <div class="col-md-5">
                <label>Mots clés ajoutés</label>
                <select class="form-control" size="6" disabled>
                    <?php foreach ($motsArticle as $mot): ?>
                        <option><?= htmlspecialchars($mot['libMotCle']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <?php if ($nbComments > 0): ?>
            <p class="text-danger fw-bold">
                Remarque : Suppression impossible, il existe des commentaires associés à cet article.
            </p>
            <a href="<?= ROOT_URL . '/api/comments/delete.php?numArt=' . $numArt; ?>"
               class="btn btn-warning btn-sm"
               onclick="return confirm('Supprimer tous les commentaires de cet article ?');">
                Supprimer tous les commentaires
            </a>
        <?php endif; ?>

        <?php if ($nbLikes > 0): ?>
            <p class="text-danger fw-bold mt-3">
                Remarque : Suppression impossible, il existe des likes associés à cet article.
            </p>
            <a href="<?= ROOT_URL . '/api/likes/delete.php?numArt=' . $numArt; ?>"
               class="btn btn-warning btn-sm"
               onclick="return confirm('Supprimer tous les likes de cet article ?');">
                Supprimer tous les likes
            </a>
        <?php endif; ?>

        <a href="list.php" class="btn btn-primary">List</a>
        <button class="btn btn-danger" <?= ($nbComments > 0 || $nbLikes > 0) ? 'disabled' : '' ?> >
            Confirmer Delete ?
        </button>

    </form>
</div>

<?php include '../../../footer.php'; ?>
