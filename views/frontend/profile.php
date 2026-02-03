<?php
require_once '../../header.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/update.php';

if (empty($_SESSION['user'])) {
    header('Location: ../../views/backend/security/login.php');
    exit;
}

$numMemb = $_SESSION['user']['id'];
$message = '';
$error = '';

$user = sql_select("MEMBRE", "*", "numMemb = $numMemb");
$user = $user[0] ?? null;

if (!$user) {
    $error = "Utilisateur introuvable.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $pseudo      = trim($_POST['pseudo'] ?? '');
    $prenom      = trim($_POST['prenom'] ?? '');
    $nom         = trim($_POST['nom'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $oldPass     = trim($_POST['oldPass'] ?? '');
    $pass        = trim($_POST['pass'] ?? '');
    $passConf    = trim($_POST['passConf'] ?? '');

    if (empty($pseudo) || empty($email)) {
        $error = "Le pseudo et l'email sont requis.";
    } elseif (!empty($pass) && $pass !== $passConf) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif (!empty($pass) && (strlen($pass) < 8 || strlen($pass) > 15)) {
        $error = "Le mot de passe doit contenir entre 8 et 15 caractères.";
    } elseif (!empty($pass) && empty($oldPass)) {
        $error = "L'ancien mot de passe est requis pour en changer.";
    } elseif (!empty($pass) && !password_verify($oldPass, $user['passMemb'])) {
        $error = "L'ancien mot de passe est incorrect.";
    } else {
        $existingEmail = sql_select(
            "MEMBRE",
            "*",
            "eMailMemb = '$email' AND numMemb != $numMemb"
        );

        if (!empty($existingEmail)) {
            $error = "Cet email est déjà utilisé.";
        } else {
            $updateFields = "pseudoMemb = '$pseudo', prenomMemb = '$prenom', nomMemb = '$nom', eMailMemb = '$email'";

            if (!empty($pass)) {
                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                $updateFields .= ", passMemb = '$hashedPass'";
            }

            sql_update("MEMBRE", $updateFields, "numMemb = $numMemb");

            $_SESSION['user']['pseudo'] = $pseudo;

            $message = "Profil mis à jour avec succès.";

            $user = sql_select("MEMBRE", "*", "numMemb = $numMemb");
            $user = $user[0] ?? null;
        }
    }
}
?>

<main class="auth-page">
  <section class="auth-card">

    <h2 class="auth-title">Mon profil</h2>

    <?php if ($message): ?>
      <div class="auth-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="auth-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($user): ?>
      <form method="POST" class="auth-form">

        <input
          type="text"
          name="pseudo"
          placeholder="Pseudo"
          value="<?= htmlspecialchars($user['pseudoMemb']) ?>"
          required
        >

        <input
          type="text"
          name="prenom"
          placeholder="Prénom"
          value="<?= htmlspecialchars($user['prenomMemb']) ?>"
        >

        <input
          type="text"
          name="nom"
          placeholder="Nom"
          value="<?= htmlspecialchars($user['nomMemb']) ?>"
        >

        <input
          type="email"
          name="email"
          placeholder="Email"
          value="<?= htmlspecialchars($user['eMailMemb']) ?>"
          required
        >

        <input
          type="password"
          name="oldPass"
          placeholder="Ancien mot de passe (requis pour en changer)"
        >

        <input
          type="password"
          name="pass"
          placeholder="Nouveau mot de passe"
        >

        <input
          type="password"
          name="passConf"
          placeholder="Confirmation du mot de passe"
        >

        <button type="submit" class="btn-primary">
          Enregistrer les modifications
        </button>

        <a href="/" class="auth-link">
          Retour à l’accueil
        </a>

      </form>
    <?php endif; ?>

  </section>
</main>

<?php require_once '../../footer.php'; ?>
