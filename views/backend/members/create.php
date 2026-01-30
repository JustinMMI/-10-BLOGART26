<?php
include '../../../header.php'; 
$statuts = sql_select("STATUT", "*");
?>


<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau Membre</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/members/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo (non modifiable)</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" maxlength="70" type="text" required />
                    <div id="pseudoMemb" class="form-text">
                    (Entre 6 et 70 car.)
                    </div>
                    

                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" required />

                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" required />

                    <label for="passMemb" class="form-label">Password</label>
                    <input type="password" id="passMemb" name="passMemb" class="form-control" maxlength="15">
                    <div id="passwordHelpBlock" class="form-text">
                    (Entre 8 et 15 car., au - une majuscule, une minuscule, un chiffre, car. spéciaux acceptés)
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="showPassMemb">
                    <label class="form-check-label" for="showPassMemb">
                        Afficher Mot de passe
                    </label>
                    </div>

                    <label for="passMembConfirm" class="form-label">Confirmez password</label>
                    <input type="password" id="passMembConfirm" name="passMembConfirm" class="form-control" maxlength="15">
                    <div id="passwordHelpBlock" class="form-text">
                    (Entre 8 et 15 car., au - une majuscule, une minuscule, un chiffre, car. spéciaux acceptés)
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="showPassMembConfirm">
                    <label class="form-check-label" for="showPassMembConfirm">
                        Afficher Mot de passe
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


                    <label for="eMailMemb">eMail</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="text" autofocus="autofocus" />

                    <label for="eMailMembConfirm">Confirmez eMail</label>
                    <input id="eMailMembConfirm" name="eMailMembConfirm" class="form-control" type="text" autofocus="autofocus" />

                    <p id="accordMembL">J'accepte que mes données soient conservées</p>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accordMemb" id="accordMembOui" value="1">
                        <label class="form-check-label" for="accordMembOui">Oui</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accordMemb" id="accordMembNon" value="0" checked>
                        <label class="form-check-label" for="accordMembNon">Non</label>
                    </div>


                    <p><b>Statut :</b></p>
                    <select class="form-select" name="numStat" label="Choix du statut">
                        <option value="">-- Choisir un statut --</option>

                        <?php foreach ($statuts as $statut) { ?>
                            <option value="<?php echo $statut['numStat']; ?>">
                                <?php echo $statut['libStat']; ?>
                            </option>
                        <?php } ?>

                    </select>

                </div>

                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
