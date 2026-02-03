<?php
include '../../../header.php';

// Vérifier que numCom existe et est valide
if (!isset($_GET['numCom']) || !is_numeric($_GET['numCom'])) {
    echo '<div class="alert alert-danger" role="alert">Erreur : ID de commentaire invalide.</div>';
    exit;
}

$idCommentaire = (int)$_GET['numCom'];
$commentaire = sql_select('COMMENT', '*', 'numCom = ' . $idCommentaire);

// Vérifier que le commentaire existe
if (empty($commentaire)) {
    echo '<div class="alert alert-danger" role="alert">Commentaire non trouvé.</div>';
    exit;
}

if (is_array($commentaire) && !empty($commentaire)) {
    $commentaire = $commentaire[0];
}

?>
<form method="POST" action="delete.php?numCom=<?php echo $idCommentaire; ?>">
    <div class="form-group">
        <label for="libCom">Commentaire</label>
        <textarea class="form-control" id="libCom" rows="3" disabled><?php echo ($commentaire['libCom']); ?></textarea>
    </div>
    
    <button type="submit" name="confirmer" class="btn btn-danger">Supprimer le commentaire</button>
    <a href="list.php" class="btn btn-secondary">Annuler</a>
</form>

<?php
if (isset($_POST['confirmer'])) {
    
    // Supprimer le commentaire
    $resultat = sql_delete('COMMENT', 'numCom = ' . $idCommentaire);
    
    if ($resultat === true) {
        header('Location: list.php?message=Commentaire supprimé avec succès');
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de la suppression du commentaire.</div>';
    }
}

