<?php
include '../../../header.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('page');

$numMotCle = (int)($_GET['numMotCle'] ?? 0);

if ($numMotCle <= 0) {
    header('Location: list.php?error=Mot-clé invalide');
    exit;
}

$motCle = sql_select("MOTCLE", "*", "numMotCle = $numMotCle");
$motCle = $motCle[0] ?? null;

if (!$motCle) {
    header('Location: list.php?error=Mot-clé introuvable');
    exit;
}

$nbLiens = sql_select(
    "MOTCLEARTICLE",
    "COUNT(*) AS total",
    "numMotCle = $numMotCle"
)[0]['total'];

$canDelete = ($nbLiens == 0);
?>

<div class="container">
    <h1>Suppression Mot-clé</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/keywords/delete.php" method="post">

        <input type="hidden" name="numMotCle" value="<?= $numMotCle ?>">

        <div class="form-group mb-3">
            <label>Mot-clé</label>
            <input
                class="form-control"
                value="<?= htmlspecialchars($motCle['libMotCle']) ?>"
                readonly
            >
        </div>

        <div class="mt-3">
            <a href="list.php" class="btn btn-primary">List</a>

            <?php if ($canDelete): ?>
                <button type="submit" class="btn btn-danger">
                    Confirmer la suppression
                </button>
            <?php else: ?>
                <button type="button" class="btn btn-secondary" disabled>
                    Veuillez d’abord supprimer tous les liens associés à ce mot-clé
                </button>
                <a href="<?= ROOT_URL ?>/api/keywords/delete.php?numMotCle=<?= $numMotCle ?>&unlink=1"
                   class="btn btn-warning ms-2"
                   onclick="return confirm('Délier ce mot-clé de tous les articles ?');">
                    Délier le mot-clé de tous les articles
                </a>
            <?php endif; ?>
        </div>

    </form>
</div>
