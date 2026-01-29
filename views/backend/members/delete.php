<?php
include '../../../header.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if (isset($_GET['numMemb'])) {
    $numMemb = (int) $_GET['numMemb'];
    $membre = sql_select("MEMBRE", "pseudoMemb", "numMemb = $numMemb")[0];
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Membre</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php eacho ROOT_URL . '/api/members/delete.php'; ?>" method="post">

                <input type="hidden" name="numMemb" value="<?= $numMemb ?>">

                <div class="form-group">
                    <label>Pseudo</label>
                    <input class="form-control" value="<?= htmlspecialchars($membre['pseudoMemb']); ?>" disabled>
                </div>

                <br>
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
            </form>
        </div>
    </div>
</div>

