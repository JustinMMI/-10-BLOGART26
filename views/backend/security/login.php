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

    if (empty($_POST['g-recaptcha-response'])) {
        $error = "Veuillez valider le captcha.";
    } else {

        $secretKey = '6Ld0GlssAAAAADiS4gh097petnjcA1nTMO1PS-JO'; // 🔐 TA CLÉ SECRÈTE
        $captchaResponse = $_POST['g-recaptcha-response'];

        $verify = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse"
        );

        $responseData = json_decode($verify);

        if (!$responseData->success) {
            $error = "Captcha invalide.";
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

        <!-- reCAPTCHA v2 -->
        <div class="g-recaptcha mb-3"
             data-sitekey="6Ld0GlssAAAAAHLBmEi-bB9vXrPbv1vYF_foDuvk">
        </div>

        <button type="submit" class="btn btn-primary">
            Connexion
        </button>

        <a href="signup.php" class="btn btn-secondary ms-2">
            Créer un compte
        </a>

    </form>
</div>


