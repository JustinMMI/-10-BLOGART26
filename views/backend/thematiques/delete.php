<?php
include '../../../header.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if (isset($_GET['numThem'])) {
    $numThem = (int) $_GET['numThem'];
    $thematique = sql_select("THEMATIQUE", "libThem", "numThem = $numThem")[0];
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Thématique</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/thematiques/delete.php'; ?>" method="post">

                <input type="hidden" name="numThem" value="<?= $numThem ?>">

                <div class="form-group">
                    <label>Thématique</label>
                    <input class="form-control" value="<?= htmlspecialchars($thematique['libThem']); ?>" disabled>
                </div>

                <br>
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
            </form>
        </div>
    </div>
</div>