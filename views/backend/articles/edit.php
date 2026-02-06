<?php
include '../../../header.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('page');
$numArt = (int) $_GET['numArt'];

/* =========================
   ARTICLE + THÉMATIQUE
========================= */
$articleResult = sql_select(
    "ARTICLE a INNER JOIN THEMATIQUE t ON a.numThem = t.numThem",
    "a.*, t.libThem",
    "a.numArt = $numArt"
);

if (empty($articleResult)) {
    header('Location: list.php');
    exit;
}

$article = $articleResult[0];

/* =========================
   THÉMATIQUES
========================= */
$thematiques = sql_select("THEMATIQUE", "*");

/* =========================
   MOTS-CLÉS
========================= */
$allMots = sql_select("MOTCLE", "*");

$motsArticle = sql_select(
    "MOTCLEARTICLE ma INNER JOIN MOTCLE mc ON ma.numMotCle = mc.numMotCle",
    "mc.numMotCle, mc.libMotCle",
    "ma.numArt = $numArt"
);

$idsMotsArticle = array_column($motsArticle, 'numMotCle');
?>

<div class="container">
    <h1>Édition Article</h1>

    <form action="<?= ROOT_URL . '/api/articles/update.php' ?>" method="post" enctype="multipart/form-data">

        <input type="hidden" name="numArt" value="<?= $numArt ?>">

        <label>Titre</label>
        <input name="libTitrArt" class="form-control mb-2"
               value="<?= htmlspecialchars($article['libTitrArt']) ?>" required>

        <label>Chapeau</label>
        <textarea name="libChapoArt" class="form-control mb-3" rows="4"><?= htmlspecialchars($article['libChapoArt']) ?></textarea>

        <label>Accroche paragraphe 1</label>
        <input name="libAccrochArt" class="form-control mb-2"
               value="<?= htmlspecialchars($article['libAccrochArt']) ?>">

        <label>Paragraphe 1</label>
        <textarea name="parag1Art" class="form-control mb-3" rows="6"><?= htmlspecialchars($article['parag1Art']) ?></textarea>

        <label>Sous-titre 1</label>
        <input name="libSsTitr1Art" class="form-control mb-2"
               value="<?= htmlspecialchars($article['libSsTitr1Art']) ?>">

        <label>Paragraphe 2</label>
        <textarea name="parag2Art" class="form-control mb-3" rows="6"><?= htmlspecialchars($article['parag2Art']) ?></textarea>

        <label>Sous-titre 2</label>
        <input name="libSsTitr2Art" class="form-control mb-2"
               value="<?= htmlspecialchars($article['libSsTitr2Art']) ?>">

        <label>Paragraphe 3</label>
        <textarea name="parag3Art" class="form-control mb-3" rows="6"><?= htmlspecialchars($article['parag3Art']) ?></textarea>

        <label>Conclusion</label>
        <textarea name="libConclArt" class="form-control mb-4" rows="4"><?= htmlspecialchars($article['libConclArt']) ?></textarea>

        <!-- IMAGE -->
        <label>Importer une nouvelle illustration</label>
        <input type="file" name="urlPhotArt" class="form-control mb-3" accept=".jpg,.jpeg,.png,.gif">

        <?php if (!empty($article['urlPhotArt'])): ?>
            <div class="mb-4">
                <p class="fw-bold">Image actuelle :</p>
                <img src="<?= ROOT_URL . '/src/uploads/' . htmlspecialchars($article['urlPhotArt']) ?>"
                     class="img-fluid d-block"
                     style="max-width:600px">
            </div>
        <?php endif; ?>

        <!-- THÉMATIQUE -->
        <div class="mb-4">
            <label class="fw-bold">Thématique :</label>
            <select name="numThem" class="form-control" required>
                <?php foreach ($thematiques as $t): ?>
                    <option value="<?= (int)$t['numThem'] ?>"
                        <?= (int)$t['numThem'] === (int)$article['numThem'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['libThem']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- MOTS-CLÉS -->
        <label>Choisissez les mots clés liés à l'article :</label>

        <div class="row mb-4">
            <!-- DISPONIBLES -->
            <div class="col-md-5">
                <label>Liste Mots clés</label>
                <select id="mots-dispo" class="form-control" size="8" multiple>
                    <?php foreach ($allMots as $mot): ?>
                        <?php if (!in_array($mot['numMotCle'], $idsMotsArticle, true)): ?>
                            <option value="<?= (int)$mot['numMotCle'] ?>">
                                <?= htmlspecialchars($mot['libMotCle']) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- BOUTONS -->
            <div class="col-md-2 text-center align-self-center">
                <button type="button" id="btn-add" class="btn btn-secondary mb-2">
                    Ajouter &gt;&gt;
                </button>
                <br>
                <button type="button" id="btn-remove" class="btn btn-secondary">
                    &lt;&lt; Supprimer
                </button>
            </div>

            <!-- AJOUTÉS -->
            <div class="col-md-5">
                <label>Mots clés ajoutés</label>
                <select id="mots-ajoutes" name="mots[]" class="form-control" size="8" multiple>
                    <?php foreach ($motsArticle as $mot): ?>
                        <option value="<?= (int)$mot['numMotCle'] ?>">
                            <?= htmlspecialchars($mot['libMotCle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <a href="list.php" class="btn btn-primary me-2">Liste</a>
            <button type="submit" class="btn btn-warning">Confirmer l’édition</button>
        </div>

    </form>
</div>

<?php include '../../../footer.php'; ?>
