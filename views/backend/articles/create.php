<?php
include '../../../header.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

// Charger les thématiques
$thematiques = sql_select("THEMATIQUE", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouvel Article</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/create.php'; ?>" method="post">

                <div class="form-group">
                    <label>Titre</label>
                    <input name="libTitrArt" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Chapo</label>
                    <textarea name="libChapoArt" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group mt-2">
                    <label>Thématique</label>
                    <select name="numThem" class="form-control" required>
                        <?php foreach ($thematiques as $t): ?>
                            <option value="<?= $t['numThem']; ?>">
                                <?= htmlspecialchars($t['libThem']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label>Image (nom du fichier)</label>
                    <input name="urlPhotArt" class="form-control">
                </div>

                <br>
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-success">Confirmer create ?</button>
            </form>
        </div>
    </div>
</div>
