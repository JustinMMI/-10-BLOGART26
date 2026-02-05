<?php
define('PUBLIC_PAGE', true);
include '../../../header.php';

$error   = $_GET['error']   ?? '';
$success = $_GET['success'] ?? '';
?>

<main class="auth-page">
  <section class="auth-card">

    <h2 class="auth-title">Inscription</h2>

    <?php if ($error): ?>
      <div class="auth-error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
      <div class="auth-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form
      class="auth-form"
      id="signupForm"
      method="post"
      action="<?= ROOT_URL ?>/api/security/signup.php"
    >

      <input type="hidden" name="recaptcha_token" id="recaptcha_token">

      <input type="text" name="prenom" placeholder="Prénom" required>
      <input type="text" name="nom" placeholder="Nom" required>
      <input type="text" name="pseudo" placeholder="Pseudo" maxlength="70" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Mot de passe" maxlength="15" required>
      <input type="password" name="confirm" placeholder="Confirmation du mot de passe" maxlength="15" required>

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

    grecaptcha.execute('6LewKl8sAAAAAApTAS7X8kAdof0A4yzZlIq9BoAb', { action: 'signup' })
        .then(function (token) {
            document.getElementById('recaptcha_token').value = token;
            e.target.submit();
        });
});
</script>

