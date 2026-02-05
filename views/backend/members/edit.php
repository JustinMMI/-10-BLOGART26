<?php
require_once '../../../header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

$numMemb = (int)($_GET['numMemb'] ?? 0);

if ($numMemb === 0) {
    echo "<div class='alert alert-danger'>Erreur : Aucun membre sélectionné.</div>";
    require_once '../../../footer.php';
    exit();
}

$membre = sql_select("MEMBRE", "*", "numMemb = $numMemb");
$membre = $membre[0] ?? null;

$statuts = sql_select("STATUT", "*");

if (!$membre) {
    echo "<div class='alert alert-danger'>Erreur : Membre introuvable.</div>";
    require_once '../../../footer.php';
    exit();
}
?>

<div class="container mt-5">
    <h2>Modification du Membre</h2>

    <form action="../../../api/members/update.php" method="POST" id="formUpdate">

        <input type="hidden" id="recaptcha_token" name="recaptcha_token">
        <input type="hidden" name="numMemb" value="<?= $membre['numMemb'] ?>">

        <div class="mb-3">
            <label class="form-label">Pseudo *</label>
            <input type="text" name="pseudoMemb" class="form-control" value="<?= htmlspecialchars($membre['pseudoMemb']) ?>" disabled>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Prénom *</label>
                <input type="text" name="prenomMemb" class="form-control" value="<?= htmlspecialchars($membre['prenomMemb']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nom *</label>
                <input type="text" name="nomMemb" class="form-control" value="<?= htmlspecialchars($membre['nomMemb']) ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="numStat" class="form-select">
                <?php foreach ($statuts as $statut): ?>
                    <option value="<?= $statut['numStat'] ?>" <?= ($statut['numStat'] == $membre['numStat']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($statut['libStat']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="eMailMemb" class="form-control" value="<?= htmlspecialchars($membre['eMailMemb']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Confirmer Email (Si changement)</label>
                <input type="email" name="eMailMembConf" class="form-control" placeholder="Répéter l'email pour valider le changement">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nouveau Mot de passe</label>
                <input type="password" name="passMemb" class="form-control" placeholder="Laisser vide pour ne pas changer">
                <small class="text-muted">8-15 caractères, 1 Maj, 1 Min, 1 Chiffre.</small>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Confirmer Mot de passe</label>
                <input type="password" name="passMembConf" class="form-control" placeholder="Répéter le mot de passe">
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date Création</label>
                <input type="text" class="form-control" value="<?= $membre['dtCreaMemb'] ?>" disabled>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Dernière Modification (Mise à jour automatique)</label>
                <input type="text" class="form-control" value="<?= $membre['dtMajMemb'] ?? '-' ?>" disabled>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" checked disabled>
            <label class="form-check-label">Accord RGPD (Données conservées)</label>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>

<script>
const form = document.getElementById('formUpdate');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    if (typeof grecaptcha === 'undefined') {
        alert('Captcha indisponible');
        return;
    }

    grecaptcha.ready(function () {
        grecaptcha.execute('<?= "6LewKl8sAAAAAApTAS7X8kAdof0A4yzZlIq9BoAb" ?>', { action: 'member_update' })
            .then(function (token) {
                document.getElementById('recaptcha_token').value = token;
                form.submit();
            });
    });
});
</script>

<?php require_once '../../../footer.php'; ?>