<?php
require_once '../../header.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/update.php';

// Vérifier que l'utilisateur est connecté
if (empty($_SESSION['user'])) {
    header('Location: ../../views/backend/security/login.php');
    exit;
}

$numMemb = $_SESSION['user']['id'];
$message = '';
$error = '';

// Récupérer les infos de l'utilisateur
$user = sql_select("MEMBRE", "*", "numMemb = $numMemb");
$user = $user[0] ?? null;

if (!$user) {
    $error = "Utilisateur introuvable.";
}

// Traiter la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $pseudo = trim($_POST['pseudo'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = trim($_POST['pass'] ?? '');
    $passConf = trim($_POST['passConf'] ?? '');
    
    if (empty($pseudo) || empty($email)) {
        $error = "Le pseudo et l'email sont requis.";
    } elseif (!empty($pass) && $pass !== $passConf) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif (!empty($pass) && (strlen($pass) < 8 || strlen($pass) > 15)) {
        $error = "Le mot de passe doit contenir entre 8 et 15 caractères.";
    } else {
        // Vérifier que l'email n'existe pas pour un autre utilisateur
        $existingEmail = sql_select("MEMBRE", "*", "eMailMemb = '$email' AND numMemb != $numMemb");
        
        if (!empty($existingEmail)) {
            $error = "Cet email est déjà utilisé.";
        } else {
            // Construire la requête de mise à jour
            $updateFields = "prenomMemb = '$prenom', nomMemb = '$nom', eMailMemb = '$email'";
            
            if (!empty($pass)) {
                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                $updateFields .= ", passMemb = '$hashedPass'";
            }
            
            sql_update("MEMBRE", $updateFields, "numMemb = $numMemb");
            
            // Mettre à jour la session
            $_SESSION['user']['pseudo'] = $pseudo;
            
            $message = "Profil mis à jour avec succès.";
            
            // Rafraîchir les données
            $user = sql_select("MEMBRE", "*", "numMemb = $numMemb");
            $user = $user[0] ?? null;
        }
    }
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Mon Profil</h3>
                </div>
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <?php if ($user): ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input type="text" class="form-control" id="pseudo" name="pseudo"
                                       value="<?= htmlspecialchars($user['pseudoMemb'] ?? '') ?>" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" 
                                           value="<?= htmlspecialchars($user['prenomMemb'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" 
                                           value="<?= htmlspecialchars($user['nomMemb'] ?? '') ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($user['eMailMemb'] ?? '') ?>" required>
                            </div>
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pass" class="form-label">Nouveau Mot de passe</label>
                                    <input type="password" class="form-control" id="pass" name="pass" 
                                           placeholder="Laisser vide pour ne pas changer">
                                    <small class="text-muted">8-15 caractères.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="passConf" class="form-label">Confirmer Mot de passe</label>
                                    <input type="password" class="form-control" id="passConf" name="passConf" 
                                           placeholder="Répéter le mot de passe">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <a href="/" class="btn btn-secondary">Retour</a>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../footer.php'; ?>
