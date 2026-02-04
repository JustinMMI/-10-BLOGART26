<?php
require_once __DIR__ . '/../../header.php';

// On simule l'envoi du message : on ne fait pas mail(), juste un message de succès
$successMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message']) && !empty($_POST['email'])) {
    // Ici, on ne fait rien, juste afficher le message
    $successMessage = 'Message envoyé avec succès ✨';
}
?>

<main class="auth-page">
  <section class="auth-card auth-card-large">

    <h2 class="auth-title">Contactez-nous</h2>

    <p class="auth-intro">
      Une question, une suggestion ou une collaboration ?
      Écrivez-nous, nous vous répondrons rapidement.
    </p>

    <?php if (!empty($_GET['error'])): ?>
      <div class="auth-error">
        <?= htmlspecialchars($_GET['error']) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($_GET['success'])): ?>
      <div class="auth-success">
        Message envoyé avec succès 🌟
      </div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
      <div class="auth-success">
        <?= htmlspecialchars($successMessage) ?>
      </div>
    <?php endif; ?>

    <form class="auth-form" method="post" id="contactForm">

      <input type="hidden" name="recaptcha_token" id="recaptcha_token">

      <input type="text" name="pseudo" placeholder="Votre pseudo" required >

      <div class="auth-form-row">
        <input type="text" name="prenom" placeholder="Prénom" required >
        <input type="text" name="nom" placeholder="Nom" required>
      </div>

      <input type="email" name="email" placeholder="Adresse email" required >

      <textarea name="message" rows="5" placeholder="Ecrivez votre message" required ></textarea>

      <button type="submit" class="btn-primary">
        Envoyer le message →
      </button>

    </form>

  </section>
</main>

<script>
document.getElementById('contactForm').addEventListener('submit', function (e) {
  e.preventDefault();

  grecaptcha.ready(function () {
    grecaptcha.execute('6LewKl8sAAAAAApTAS7X8kAdof0A4yzZlIq9BoAb', { action: 'contact' })
      .then(function (token) {
        document.getElementById('recaptcha_token').value = token;
        e.target.submit(); // soumet le formulaire après le token
      });
  });
});
</script>

<?php require_once __DIR__ . '/../../footer.php'; ?>
