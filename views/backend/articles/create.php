<?php
include '../../../header.php';

// 🔐 Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

// Thématiques
$thematiques = sql_select("THEMATIQUE", "*");

// Mots-clés
$allMots = sql_select("MOTCLE", "*");
?>

<div class="container">
    <h1>Création nouvel Article</h1>

    <form action="<?= ROOT_URL . '/api/articles/create.php'; ?>" method="post" enctype="multipart/form-data">

        <label>Titre</label>
        <input name="libTitrArt" class="form-control mb-2" required>

        <label>Chapeau</label>
        <textarea name="libChapoArt" class="form-control mb-3" rows="4"></textarea>

        <label>Accroche paragraphe 1</label>
        <input name="libAccrochArt" class="form-control mb-2">

        <label>Paragraphe 1</label>
        <textarea name="parag1Art" class="form-control mb-3" rows="6"></textarea>

        <label>Sous-titre 1</label>
        <input name="libSsTitr1Art" class="form-control mb-2">

        <label>Paragraphe 2</label>
        <textarea name="parag2Art" class="form-control mb-3" rows="6"></textarea>

        <label>Sous-titre 2</label>
        <input name="libSsTitr2Art" class="form-control mb-2">

        <label>Paragraphe 3</label>
        <textarea name="parag3Art" class="form-control mb-3" rows="6"></textarea>

        <label>Conclusion</label>
        <textarea name="libConclArt" class="form-control mb-4" rows="4"></textarea>

        <label>Importez l'illustration</label>
        <input type="file" name="urlPhotArt" class="form-control mb-4" accept=".jpg,.jpeg,.png,.gif">

        <div class="mb-4">
            <label class="fw-bold">Thématique :</label>
            <select name="numThem" class="form-control" required>
                <?php foreach ($thematiques as $t): ?>
                    <option value="<?= $t['numThem'] ?>">
                        <?= htmlspecialchars($t['libThem']) ?>
                    </option>
                <?php endforeach; ?> 
            </select>
        </div>

        <label>Choisissez les mots clés liés à l'article :</label>

        <div class="row mb-4">

            <div class="col-md-5">
                <label>Liste Mots clés</label>
                <select id="mots-dispo" class="form-control" size="8" multiple>
                    <?php foreach ($allMots as $mot): ?>
                        <?php if (!isset($idsMotsArticle) || !in_array($mot['numMotCle'], $idsMotsArticle)): ?>
                            <option value="<?= $mot['numMotCle'] ?>">
                                <?= htmlspecialchars($mot['libMotCle']); ?>
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

            <!-- LISTE AJOUTÉE -->
            <div class="col-md-5">
                <label>Mots clés ajoutés</label>
                <select id="mots-ajoutes" name="mots[]" class="form-control" size="8" multiple>
                    <?php if (isset($motsArticle)): ?>
                        <?php foreach ($motsArticle as $mot): ?>
                            <option value="<?= $mot['numMotCle'] ?>">
                                <?= htmlspecialchars($mot['libMotCle']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <a href="list.php" class="btn btn-primary">List</a>
        <button type="submit" class="btn btn-success">Confirmer Create ?</button>

    </form>
</div>

<?php include '../../../footer.php'; ?>
