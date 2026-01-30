<?php
include '../../../header.php';

// 🔐 Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if (!isset($_GET['numMemb'])) {
    header('Location: list.php');
    exit;
}

$numMemb = (int) $_GET['numMemb'];

$membre = sql_select(
    "MEMBRE",
    "pseudoMemb",
    "numMemb = $numMemb"
)[0];
?>

<div class="container mt-5" style="max-width:500px;">
    <h2 class="mb-4">Suppression Membre</h2>

    <form method="post" action="<?= ROOT_URL . '/api/members/delete.php'; ?>">

        <input type="hidden" name="numMemb" value="<?= $numMemb ?>">

        <div class="mb-3">
            <label class="fw-bold">Pseudo</label>
            <input class="form-control"
                   value="<?= htmlspecialchars($membre['pseudoMemb']); ?>"
                   disabled>
        </div>

        <div class="g-recaptcha mb-3"
             data-sitekey="6Ld0GlssAAAAAHLBmEi-bB9vXrPbv1vYF_foDuvk">
        </div>

        <a href="list.php" class="btn btn-primary">
            List
        </a>

        <button type="submit" class="btn btn-danger ms-2">
            Confirmer delete ?
        </button>

    </form>
</div>
