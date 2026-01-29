<?php
include '../../../header.php';

// LOGOUT
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$error = '';

// Traitement login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Récupération du membre
    $membre = sql_select("MEMBRE", "*", "eMailMemb = '$email'");

    if (empty($membre)) {
        $error = "Email ou mot de passe incorrect.";
    } else {
        $membre = $membre[0];

        if (!password_verify($password, $membre['passMemb'])) {
            $error = "Email ou mot de passe incorrect.";
        } else {
            // Récupération du statut
            $statut = sql_select(
                "STATUT",
                "libStat",
                "numStat = " . $membre['numStat']
            )[0]['libStat'];

            $_SESSION['user'] = [
                'id'     => $membre['numMemb'],
                'email'  => $membre['eMailMemb'],
                'pseudo' => $membre['pseudoMemb'],
                'statut' => $statut
            ];

            if ($statut === 'admin') {
                header('Location: ../dashboard.php');
            } else {
                header('Location: /index.php'); // Home
            }
            exit;
        }
    }
}
?>

<div class="container mt-5">
    <h2>Connexion</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
        <input class="form-control mb-2" name="password" type="password" placeholder="Mot de passe" required>

        <button class="btn btn-primary mt-2">Connexion</button>
        <a href="signup.php" class="btn btn-secondary mt-2">Créer un compte</a>
    </form>
</div>
