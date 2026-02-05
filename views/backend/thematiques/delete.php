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

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/thematiques/delete.php" method="post">

        <input type="hidden" name="numThem" value="<?php e(numThem ?>">

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
                <a href="<?= ROOT_URL ?>/api/thematiques/delete.php?numThem=<?php e(numThem ?>&deleteArticles=1"
                   class="btn btn-warning ms-2"
                   onclick="return confirm('Voulez vous vraiment supprimer tous les articles liés à cette thématique ? /!\\ ATTENTION /!\\ Cela supprimera également les commentaires et les likes liés à ces derniers.');">
                    Supprimer tous les articles liés à cette thématique
                </a>
            <?php endif; ?>
        </div>

    </form>
</div>
