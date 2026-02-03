<?php
include '../../../header.php';
$statuts = sql_select("STATUT", "*");

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
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

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Membre</h1>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>

                <?php 
                // Si le message d'erreur contient "commentaires" ou "likes", afficher les boutons de suppression
                $errorMsg = $_GET['error'];
                $hasComments = strpos($errorMsg, 'commentaires') !== false;
                $hasLikes = strpos($errorMsg, 'likes') !== false;
                
                if ($hasComments || $hasLikes) { 
                ?>
                    <div class="alert alert-warning">
                        <p><strong>Actions supplémentaires requises :</strong></p>
                        <?php if ($hasComments) { ?>
                            <a href="javascript:deleteComments(<?php echo $membre['numMemb']; ?>)" class="btn btn-warning btn-sm">
                                <i class="fas fa-trash"></i> Supprimer les commentaires
                            </a>
                        <?php } ?>
                        <?php if ($hasLikes) { ?>
                            <a href="javascript:deleteLikes(<?php echo $membre['numMemb']; ?>)" class="btn btn-warning btn-sm">
                                <i class="fas fa-trash"></i> Supprimer les likes
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_GET['success']); ?>
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
function deleteComments(numMemb) {
    if (confirm('Êtes-vous sûr de vouloir supprimer tous les commentaires de ce membre ?')) {
        window.location.href = '<?php echo ROOT_URL; ?>/api/comments/delete.php?numMemb=' + numMemb;
    }
}

function deleteLikes(numMemb) {
    if (confirm('Êtes-vous sûr de vouloir supprimer tous les likes de ce membre ?')) {
        window.location.href = '<?php echo ROOT_URL; ?>/api/likes/delete.php?numMemb=' + numMemb;
    }
}

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
