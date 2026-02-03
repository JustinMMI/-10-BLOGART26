<?php
include '../../../header.php';
$statuts = sql_select("STATUT", "*");

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

$numMemb = $_GET['numMemb'] ?? null;
$membre = null;

if ($numMemb) {
    $membres = sql_select(
        "MEMBRE m INNER JOIN STATUT s ON m.numStat = s.numStat",
        "m.*, s.libStat",
        "m.numMemb = $numMemb"
    );
    $membre = $membres[0] ?? null;

    if (!$membre) {
        header('Location: list.php?error=' . urlencode("Membre introuvable"));
        exit;
    }
}

if (empty($_POST['recaptcha_token'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=' . urlencode('Captcha manquant'));
    exit;
}

$token = $_POST['recaptcha_token'];

$verify = file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret=" . "6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU" . "&response=" . $token
);

$response = json_decode($verify, true);

if (
    empty($response['success']) ||
    $response['score'] < 0.5 ||
    $response['action'] !== 'member_create' ||
    $response['hostname'] !== $_SERVER['SERVER_NAME']
) {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=' . urlencode('Captcha invalide'));
    exit;
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Membre</h1>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/delete.php'; ?>" method="post">

                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                <div class="form-group">

                    <label for="numMemb">Numéro</label>
                    <input id="numMemb" name="numMemb" class="form-control" type="text" value="<?php echo htmlspecialchars($membre['numMemb']); ?>" readonly>

                    <label for="pseudoMemb">Pseudo</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" value="<?php echo htmlspecialchars($membre['pseudoMemb']); ?>" readonly>

                    <label for="dtCreaMemb">Date création</label>
                    <input id="dtCreaMemb" name="dtCreaMemb" class="form-control" type="text" value="<?php echo htmlspecialchars($membre['dtCreaMemb']); ?>" readonly>

                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" value="<?php echo htmlspecialchars($membre['prenomMemb']); ?>" readonly>

                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" value="<?php echo htmlspecialchars($membre['nomMemb']); ?>" readonly>

                    <label for="eMailMemb">Email</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="email" value="<?php echo htmlspecialchars($membre['eMailMemb']); ?>" readonly>

                    <label for="libStat">Statut</label>
                    <input id="libStat" name="libStat" class="form-control" type="text" value="<?php echo htmlspecialchars($membre['libStat']); ?>" readonly>

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

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();

    grecaptcha.execute('<?= "6LewKl8sAAAAAApTAS7X8kAdof0A4yzZlIq9BoAb" ?>', { action: 'member_delete' })
        .then(token => {
            document.getElementById('recaptcha_token').value = token;
            e.target.submit();
        });
});
</script>

<?php include '../../../footer.php'; ?>
