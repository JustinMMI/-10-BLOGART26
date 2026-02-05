<?php
include '../../../header.php';

if (!isset($_SESSION['user'])) {
    header('Location: /views/backend/security/login.php');
    exit;
}

if (isset($_GET['numStat'])) {
    $numStat = (int) $_GET['numStat'];
    $statutRow = sql_select("STATUT", "libStat", "numStat = $numStat");
    $libStat = $statutRow[0]['libStat'] ?? null;
}

if (empty($libStat)) {
    header('Location: list.php?error=' . urlencode('Statut introuvable'));
    exit;
}

$currentUserId = (int) ($_SESSION['user']['id'] ?? 0);
$currentUserStat = 0;
if ($currentUserId > 0) {
    $userStatRow = sql_select("MEMBRE", "numStat", "numMemb = $currentUserId");
    $currentUserStat = (int) ($userStatRow[0]['numStat'] ?? 0);
}

$nbMembers = sql_select(
    "MEMBRE",
    "COUNT(*) AS total",
    "numStat = $numStat"
)[0]['total'];

$availableStatuts = [];
if ($nbMembers > 0) {
    $availableStatuts = sql_select(
        "STATUT",
        "numStat, libStat",
        "numStat != $numStat"
    );
}
?>

<!-- Bootstrap crer nouveau staut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Statut</h1>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/statuts/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libStat">Nom du statut</label>
                    <input id="numStat" name="numStat" class="form-control" style="display: none" type="text" value="<?php echo($numStat); ?>" readonly="readonly" />
                    <input id="libStat" name="libStat" class="form-control" type="text" value="<?php echo($libStat); ?>" readonly="readonly" disabled />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger" <?= $nbMembers > 0 ? 'disabled' : '' ?>>Confirmer delete ?</button>
                </div>
            </form>
        </div>

        <?php if ($nbMembers > 0): ?>
            <div class="col-md-12 mt-4">
                <div class="alert alert-warning">
                    <strong><?= (int)$nbMembers; ?></strong> membre(s) utilisent ce statut.
                    <br>
                    Veuillez réattribuer un nouveau statut avant suppression.
                </div>

                <form action="<?php echo ROOT_URL . '/api/statuts/delete.php' ?>" method="post">
                    <input type="hidden" name="numStat" value="<?php echo($numStat); ?>">

                    <div class="form-group">
                        <label for="reassignStat">Nouveau statut pour les membres</label>
                        <select id="reassignStat" name="reassignStat" class="form-control" required>
                            <option value="">-- Choisir un statut --</option>
                            <?php foreach ($availableStatuts as $statutOption): ?>
                                <option value="<?= (int)$statutOption['numStat']; ?>">
                                    <?= htmlspecialchars($statutOption['libStat']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-warning"
                            onclick="return confirm('Réattribuer les membres puis supprimer le statut ?');">
                            Réattribuer et supprimer
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>