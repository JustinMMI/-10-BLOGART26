<?php
include(__DIR__ . '/../../header.php');

$statuts = sql_select("STATUT", "*");
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Formulaire de contact</h1>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/create.php'; ?>" method="post">

                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                <div class="form-group">

                    <label for="pseudoMemb">Pseudo</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" maxlength="70" type="text" required>

                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" required>

                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" required>

                    <label for="eMailMemb">Email</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="email" required>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Ecrivez votre message"></textarea>
                    </div>

                </div>

                <br>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-success">Confirmer envoi?</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();

    grecaptcha.execute('<?= "6LewKl8sAAAAAApTAS7X8kAdof0A4yzZlIq9BoAb" ?>', { action: 'member_create' })
        .then(token => {
            document.getElementById('recaptcha_token').value = token;
            e.target.submit();
        });
});
</script>

<?php include(__DIR__ . '/../../footer.php'); ?>
