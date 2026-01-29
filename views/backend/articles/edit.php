<?php
include '../../../header.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if (isset($_GET['numArt'])) {
    $numArt = (int) $_GET['numArt'];
    $article = sql_select("ARTICLE", "*", "numArt = $numArt")[0];
    $thematiques = sql_select("THEMATIQUE", "*");
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Édition Article</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/update.php'; ?>" method="post">

                <input type="hidden" name="numArt" value="<?= $numArt ?>">

                <div class="form-group">
                    <label>Titre</label>
                    <input name="libTitrArt" class="form-control"
                           value="<?= htmlspecialchars($article['libTitrArt']); ?>" required>
                </div>

                <div class="form-group mt-2">
                    <label>Chapo</label>
                    <textarea name="libChapoArt" class="form-control" rows="3">
<?= htmlspecialchars($article['libChapoArt']); ?>
                    </textarea>
                </div>

                <div class="form-group mt-2">
                    <label>Thématique</label>
                    <select name="numThem" class="form-control">
                        <?php foreach ($thematiques as $t): ?>
                            <option value="<?= $t['numThem']; ?>"
                                <?= $t['numThem'] == $article['numThem'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($t['libThem']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Image</label>
                    <input name="urlPhotArt" class="form-control"
                           value="<?= $article['urlPhotArt']; ?>">
                </div>

                <br>
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-warning">Confirmer edit ?</button>
            </form>
        </div>
    </div>
</div>
