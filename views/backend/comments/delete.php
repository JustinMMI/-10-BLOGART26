<?php
include '../../../header.php';

// Vérifier que l'ID existe et est valide
if (!isset($_GET['numCom']) || !is_numeric($_GET['numCom'])) {
    echo '<div class="alert alert-danger" role="alert">Erreur : ID de commentaire invalide.</div>';
    exit;
}

$idCommentaire = (int)$_GET['numCom'];

// ÉTAPE 7 : Générer le token CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// ÉTAPE 6 : Récupérer le commentaire avec une requête SELECT
// Format correct : sql_select('table', 'attributs', 'WHERE condition')
$commentaire = sql_select('COMMENT', '*', 'numCom = ' . $idCommentaire);

// ÉTAPE 6 : Vérifier que le commentaire existe
if (empty($commentaire)) {
    echo '<div class="alert alert-danger" role="alert">Commentaire non trouvé.</div>';
    exit;
}

// Récupérer le premier résultat (si c'est un array de résultats)
if (is_array($commentaire) && !empty($commentaire)) {
    $commentaire = $commentaire[0];
}

?>
<form method="POST" action="delete.php?numCom=<?php echo $idCommentaire; ?>">
    <div class="form-group">
        <label for="libCom">Commentaire</label>
        <textarea class="form-control" id="libCom" rows="3" disabled><?php echo htmlspecialchars($commentaire['libCom']); ?></textarea>
    </div>
    
    <!-- ÉTAPE 7 : Champ token CSRF pour sécuriser le formulaire -->
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
    
    <button type="submit" name="confirmer" class="btn btn-danger">Supprimer le commentaire</button>
    <a href="list.php" class="btn btn-secondary">Annuler</a>
</form>

<?php
// ÉTAPE 7 : Vérifier le token CSRF
if (isset($_POST['confirmer'])) {
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo '<div class="alert alert-danger" role="alert">Erreur de sécurité : token CSRF invalide.</div>';
        exit;
    }
    
    // ÉTAPE 6 : Appeler la fonction de suppression
    // Format : sql_delete('table', 'WHERE condition')
    $resultat = sql_delete('COMMENT', 'numCom = ' . $idCommentaire);
    
    // ÉTAPE 6 : Vérifier si la suppression a réussi
    if ($resultat === true) {
        header('Location: list.php?message=Commentaire supprimé avec succès');
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de la suppression du commentaire.</div>';
    }
}

