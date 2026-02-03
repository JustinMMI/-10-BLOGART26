<?php
include '../../../header.php';
$statuts = sql_select("STATUT", "*");
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau Membre</h1>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/create.php'; ?>" method="post">

                <div class="form-group">

                    <label for="pseudoMemb">Pseudo (non modifiable)</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" maxlength="70" type="text" required>

                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" required>

                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" required>

                    <label for="eMailMemb">Email</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="email" required>

                    <p class="mt-2">J'accepte que mes données soient conservées</p>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accordMemb" id="accordMembOui" value="1">
                        <label class="form-check-label" for="accordMembOui">Oui</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accordMemb" id="accordMembNon" value="0" checked>
                        <label class="form-check-label" for="accordMembNon">Non</label>
                    </div>

                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" required>

                </div>

                <br>

                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer Delete?</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include '../../../footer.php'; ?>
