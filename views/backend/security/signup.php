<?php
include '../../../header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom  = $_POST['prenom'] ?? '';
    $nom     = $_POST['nom'] ?? '';
    $pseudo  = $_POST['pseudo'] ?? '';
    $email   = $_POST['email'] ?? '';
    $pass    = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($pass !== $confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si email existe déjà
        $exist = sql_select("MEMBRE", "*", "eMailMemb = '$email'");

        if (!empty($exist)) {
            $error = "Un compte avec cet email existe déjà.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            sql_insert(
                "MEMBRE",
                "prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, numStat",
                "'$prenom', '$nom', '$pseudo', '$hash', '$email', NOW(), 1"
            );

            $success = "Compte créé avec succès. Vous pouvez vous connecter.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Inscription</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post">
        <input class="form-control mb-2" name="prenom" placeholder="Prénom" required>
        <input class="form-control mb-2" name="nom" placeholder="Nom" required>
        <input class="form-control mb-2" name="pseudo" placeholder="Pseudo" required>
        <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
        <input class="form-control mb-2" name="password" type="password" placeholder="Mot de passe" required>
        <input class="form-control mb-2" name="confirm" type="password" placeholder="Confirmation" required>

        <button class="btn btn-success mt-2">Créer le compte</button>
        <a href="login.php" class="btn btn-primary mt-2">Connexion</a>
    </form>
</div>
