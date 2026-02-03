<?php
include '../../../header.php';
$statuts = sql_select("STATUT", "*");
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
                    <div class="form-text">(Entre 6 et 70 caractères)</div>

                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" required>

                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" required>

                    <label for="passMemb">Mot de passe</label>
                    <input type="password" id="passMemb" name="passMemb" class="form-control" maxlength="15" required>
                    <div class="form-text">
                        (Entre 8 et 15 caractères, au moins une majuscule, une minuscule, un chiffre et un caractère spécial)
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="showPassMemb">
                        <label class="form-check-label" for="showPassMemb">
                            Afficher le mot de passe
                        </label>
                    </div>

                    <label for="passMembConfirm">Confirmez le mot de passe</label>
                    <input type="password" id="passMembConfirm" name="passMembConfirm" class="form-control" maxlength="15" required>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="showPassMembConfirm">
                        <label class="form-check-label" for="showPassMembConfirm">
                            Afficher le mot de passe
                        </label>
                    </div>

                    <script>
                        document.getElementById('showPassMemb').addEventListener('change', function () {
                            document.getElementById('passMemb').type = this.checked ? 'text' : 'password';
                        });

                        document.getElementById('showPassMembConfirm').addEventListener('change', function () {
                            document.getElementById('passMembConfirm').type = this.checked ? 'text' : 'password';
                        });
                    </script>

                    <label for="eMailMemb">Email</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="email" required>

                    <label for="eMailMembConfirm">Confirmez Email</label>
                    <input id="eMailMembConfirm" name="eMailMembConfirm" class="form-control" type="email" required>

                    <p class="mt-2">J'accepte que mes données soient conservées</p>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accordMemb" id="accordMembOui" value="1">
                        <label class="form-check-label" for="accordMembOui">Oui</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accordMemb" id="accordMembNon" value="0" checked>
                        <label class="form-check-label" for="accordMembNon">Non</label>
                    </div>

                    <p class="mt-3"><b>Statut :</b></p>
                    <select class="form-select" name="numStat" required>
                        <option value="">-- Choisir un statut --</option>
                        <?php foreach ($statuts as $statut) { ?>
                            <option value="<?php echo $statut['numStat']; ?>">
                                <?php echo $statut['libStat']; ?>
                            </option>
                        <?php } ?>
                    </select>

                </div>

                <br>

                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer la création</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include '../../../footer.php'; ?>
