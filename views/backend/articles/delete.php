<?php
include '../../../header.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if (isset($_GET['numArt'])) {
    $numArt = (int) $_GET['numArt'];
    $article = sql_select("ARTICLE", "libTitrArt", "numArt = $numArt")[0];
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Article</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/delete.php'; ?>" method="post">

                <input type="hidden" name="numArt" value="<?= $numArt ?>">

                <div class="form-group">
                    <label>Titre</label>
                    <input class="form-control" value="<?= htmlspecialchars($article['libTitrArt']); ?>" disabled>
                </div>

                <br>
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
            </form>
        </div>
    </div>
</div>
