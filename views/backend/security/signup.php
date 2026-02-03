<?php
include '../../../header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['g-recaptcha-response'])) {
        $error = "Veuillez valider le captcha.";
    } else {

        $secretKey = '6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU';
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

<main class="auth-page">
  <section class="auth-card">

    <h2 class="auth-title">Inscription</h2>

    <?php if ($error): ?>
      <div class="auth-error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
      <div class="auth-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post" class="auth-form" id="signupForm">

      <input type="hidden" name="recaptcha_token" id="recaptcha_token">

      <input
        type="text"
        name="prenom"
        placeholder="Prénom"
        required
      >

      <input
        type="text"
        name="nom"
        placeholder="Nom"
        required
      >

      <input
        type="text"
        name="pseudo"
        placeholder="Pseudo"
        required
      >

      <input
        type="email"
        name="email"
        placeholder="Email"
        required
      >

      <input
        type="password"
        name="password"
        placeholder="Mot de passe"
        required
      >

      <input
        type="password"
        name="confirm"
        placeholder="Confirmation du mot de passe"
        required
      >

      <button type="submit" class="btn-primary">
        Créer le compte
      </button>

      <a href="login.php" class="auth-link">
        Déjà un compte ? Connexion
      </a>

    </form>

  </section>
</main>

<script>
document.getElementById('signupForm').addEventListener('submit', function (e) {
    e.preventDefault();

    grecaptcha.execute('<?= RECAPTCHA_SITE_KEY ?>', { action: 'signup' })
        .then(function (token) {
            document.getElementById('recaptcha_token').value = token;
            e.target.submit();
        });
});
</script>
