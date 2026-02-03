<?php
include '../../../header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

$numThem = (int)($_GET['numThem'] ?? 0);

if ($numThem <= 0) {
    header('Location: list.php?error=Thématique invalide');
    exit;
}

$thematique = sql_select("THEMATIQUE", "*", "numThem = $numThem");
$thematique = $thematique[0] ?? null;

if (!$thematique) {
    header('Location: list.php?error=Thématique introuvable');
    exit;
}

$nbArticles = sql_select(
    "ARTICLE",
    "COUNT(*) AS total",
    "numThem = $numThem"
)[0]['total'];

$canDelete = ($nbArticles == 0);
?>

<div class="container">
    <h1>Suppression Thématique</h1>

    <form action="<?= ROOT_URL ?>/api/thematiques/delete.php" method="post">

        <input type="hidden" name="numThem" value="<?= $numThem ?>">

        <div class="form-group mb-3">
            <label>Thématique</label>
            <input
                class="form-control"
                value="<?= htmlspecialchars($thematique['libThem']) ?>"
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
                    Veuillez d’abord supprimer tous les articles liés à cette thématique
                </button>
            <?php endif; ?>
        </div>

    </form>
</div>
