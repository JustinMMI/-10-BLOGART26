<?php
include '../../../header.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if (isset($_GET['numThem'])) {
    $numThem = (int) $_GET['numThem'];
    $thematique = sql_select("THEMATIQUE", "*", "numThem = $numThem")[0];
    $thematiques = sql_select("THEMATIQUE", "*");
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Édition Thématique</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/thematiques/update.php'; ?>" method="post">
                <input type="hidden" name="numThem" value="<?= $numThem ?>">

                <div class="form-group">
                    <label>Thématique</label>
                    <input name="libThem" class="form-control"
                            value="<?= htmlspecialchars($thematique['libThem']); ?>" required>
                </div>

                <br>
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-warning">Confirmer edit ?</button>
            </form>
        </div>
    </div>
</div>
