<?php
include '../../../header.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

// Charger les thématiques
$thematiques = sql_select("THEMATIQUE", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Liste des Thématiques</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/thematiques/create.php'; ?>" method="post">

                <div class="form-group">
                    <label>Thématique</label>
                    <input name="libThem" class="form-control" required>
                </div>

                <br>
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-success">Confirmer create ?</button>
            </form>
        </div>
    </div>
</div>
