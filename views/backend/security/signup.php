<?php
include '../../../header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* =========================
       CAPTCHA reCAPTCHA v2
    ========================= */
    if (empty($_POST['g-recaptcha-response'])) {
        $error = "Veuillez valider le captcha.";
    } else {

        $secretKey = '6Ld0GlssAAAAADiS4gh097petnjcA1nTMO1PS-JO';
        $captchaResponse = $_POST['g-recaptcha-response'];

        $verify = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse"
        );

        $responseData = json_decode($verify);

        if (!$responseData->success) {
            $error = "Captcha invalide.";
        }
    }

    /* =========================
       INSCRIPTION
    ========================= */
    if (!$error) {

        $prenom  = trim($_POST['prenom']);
        $nom     = trim($_POST['nom']);
        $pseudo  = trim($_POST['pseudo']);
        $email   = trim($_POST['email']);
        $pass    = $_POST['password'];
        $confirm = $_POST['confirm'];

        if ($pass !== $confirm) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {

            // Email déjà utilisé ?
            $exist = sql_select("MEMBRE", "*", "eMailMemb = '$email'");

            if (!empty($exist)) {
                $error = "Un compte avec cet email existe déjà.";
            } else {

                $hash = password_hash($pass, PASSWORD_DEFAULT);

                $statutMembre = sql_select(
                    "STATUT",
                    "numStat",
                    "libStat = 'Membre'"
                )[0]['numStat'];

                sql_insert(
                    "MEMBRE",
                    "prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, numStat",
                    "'$prenom', '$nom', '$pseudo', '$hash', '$email', NOW(), $statutMembre"
                );

                $success = "Compte créé avec succès. Vous pouvez vous connecter.";
            }
        }
    }
}
?>

<div class="container mt-5" style="max-width:500px;">
    <h2 class="mb-4">Inscription</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post">

        <input class="form-control mb-2"
               name="prenom"
               placeholder="Prénom"
               required>

        <input class="form-control mb-2"
               name="nom"
               placeholder="Nom"
               required>

        <input class="form-control mb-2"
               name="pseudo"
               placeholder="Pseudo"
               required>

        <input class="form-control mb-2"
               name="email"
               type="email"
               placeholder="Email"
               required>

        <input class="form-control mb-2"
               name="password"
               type="password"
               placeholder="Mot de passe"
               required>

        <input class="form-control mb-3"
               name="confirm"
               type="password"
               placeholder="Confirmation"
               required>

        <!-- reCAPTCHA v2 -->
        <div class="g-recaptcha mb-3"
             data-sitekey="6Ld0GlssAAAAAHLBmEi-bB9vXrPbv1vYF_foDuvk">
        </div>

        <button type="submit" class="btn btn-success">
            Créer le compte
        </button>

        <a href="login.php" class="btn btn-primary ms-2">
            Connexion
        </a>

    </form>
</div>
