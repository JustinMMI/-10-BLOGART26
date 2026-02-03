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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['recaptcha_token'])) {
        $error = "Captcha manquant.";
    } else {

        $secretKey = '6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU';
        $token = $_POST['recaptcha_token'];

        $verify = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$token"
        );

        $responseData = json_decode($verify, true);

        if (
            empty($responseData['success']) ||
            $responseData['score'] < 0.5 ||
            $responseData['action'] !== 'login'
        ) {
            $error = "Comportement suspect détecté.";
        }
    }

    if (!$error) {

        $email    = $_POST['email'];
        $password = $_POST['password'];

        $membre = sql_select("MEMBRE", "*", "eMailMemb = '$email'");

        if (empty($membre)) {
            $error = "Email ou mot de passe incorrect.";
        } else {

            $membre = $membre[0];

            if (!password_verify($password, $membre['passMemb'])) {
                $error = "Email ou mot de passe incorrect.";
            } else {

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

                header('Location: /index.php');
                exit;
            }
        }
    }
}
?>

<div class="container mt-5" style="max-width:500px;">
    <h2 class="mb-4">Connexion</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">

        <input type="hidden" name="recaptcha_token" id="recaptcha_token">
        <input class="form-control mb-2"
               name="email"
               type="email"
               placeholder="Email"
               required>

        <input class="form-control mb-3"
               name="password"
               type="password"
               placeholder="Mot de passe"
               required>

        <button type="submit" class="btn btn-primary">
            Connexion
        </button>

        <a href="signup.php" class="btn btn-secondary ms-2">
            Créer un compte
        </a>

    </form>
</div>

<script>
grecaptcha.ready(function () {
    grecaptcha.execute('TA_SITE_KEY_V3', { action: 'login' })
        .then(function (token) {
            document.getElementById('recaptcha_token').value = token;
        });
});
</script>


