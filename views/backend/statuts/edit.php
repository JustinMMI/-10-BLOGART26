<?php
include '../../../header.php';

requireAdmin('page');

$numStat = (int)($_GET['numStat'] ?? 0);

if ($numStat <= 0) {
    header('Location: list.php?error=Statut invalide');
    exit;
}

$statut = sql_select("STATUT", "*", "numStat = $numStat");
$statut = $statut[0] ?? null;

if (!$statut) {
    header('Location: list.php?error=Statut introuvable');
    exit;
}
?>

<div class="container mt-5">
    <h1>Modifier un statut</h1>

    <form action="<?= ROOT_URL ?>/api/statuts/update.php" method="post">

        <input type="hidden" name="numStat" value="<?= $statut['numStat'] ?>">

        <div class="form-group mb-3">
            <label>Numéro</label>
            <input class="form-control" type="text" value="<?= $statut['numStat'] ?>" readonly>
        </div>

        <div class="form-group mb-3">
            <label>Libellé actuel</label>
            <input class="form-control" type="text" value="<?= htmlspecialchars($statut['libStat']) ?>" readonly>
        </div>

        <div class="form-group mb-3">
            <label for="libStat">Nouveau libellé</label>
            <input
                id="libStat"
                name="libStat"
                class="form-control"
                type="text"
                value="<?= htmlspecialchars($statut['libStat']) ?>"
                required
                autofocus
            >
        </div>

        <div class="mt-3">
            <a href="list.php" class="btn btn-primary">List</a>
            <button type="submit" class="btn btn-success">Confirmer modification</button>
        </div>

    </form>
</div>
