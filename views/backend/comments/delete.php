<?php
include '../../../header.php';
?>

<?php
// Vérifier que numCom est fourni et est un nombre
if (!isset($_GET['numCom']) || !is_numeric($_GET['numCom'])) {
    echo '<div class="alert alert-danger" role="alert">Erreur : ID de commentaire invalide.</div>';
    exit;
}

// Récupérer et sécuriser l'ID
$idCommentaire = (int)$_GET['numCom'];
if ($idCommentaire <= 0) {
    echo '<div class="alert alert-danger">ID du commentaire invalide.</div>';
    exit;
}

// Récupérer le commentaire depuis la BDD
$commentaire = sql_select('COMMENT', '*', 'numCom = ' . $idCommentaire);
if (empty($commentaire)) {
    echo '<div class="alert alert-danger">Commentaire non trouvé.</div>';
    exit;
}
$commentaire = $commentaire[0];
?>


<div class="container">
    <form method="POST" action="<?= ROOT_URL . '/api/comments/delete.php'; ?>">

    <input type="hidden" name="numCom" value="<?= $commentaire['numCom']; ?>">

    <input type="hidden" name="redirect"
           value="/views/backend/comments/list.php">

    <div class="form-group">
        <h2 class="mt-5" for="libCom">Commentaire</h2>
        <textarea class="form-control mt-3" id="libCom" rows="3" disabled>
    <?= htmlspecialchars($commentaire['libCom']); ?>
        </textarea>
    </div>

    <button type="submit" class="btn btn-danger mt-3">
        Supprimer le commentaire
    </button>

    <a href="list.php" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>



