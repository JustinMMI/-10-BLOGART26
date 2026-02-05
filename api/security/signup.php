<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/getExistPseudo.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /views/backend/security/login.php');
    exit;
}

/* ===== reCAPTCHA ===== */
if (!isset($_POST['recaptcha_token'])) {
    header('Location: /views/backend/security/signup.php?error=' . urlencode('Captcha manquant'));
    exit;
}

$token = $_POST['recaptcha_token'];
$url = 'https://www.google.com/recaptcha/api/siteverify';

$data = [
    'secret'   => '6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU',
    'response' => $token
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    ]
];

$context  = stream_context_create($options);
$result   = file_get_contents($url, false, $context);
$response = json_decode($result);

if (!$response->success || $response->score < 0.5) {
    header('Location: /views/backend/security/signup.php?error=' . urlencode('Captcha invalide'));
    exit;
}
/* ===================== */

$statutMembre = sql_select("STATUT", "numStat", "libStat = 'Membre'")[0]['numStat'];

$pseudo   = trim($_POST['pseudo']);
$prenom   = trim($_POST['prenom']);
$nom      = trim($_POST['nom']);
$password = $_POST['password'];
$confirm  = $_POST['confirm'];
$email    = trim($_POST['email']);

$exist = sql_select("MEMBRE", "*", "eMailMemb = '$email'");
$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/';

if (get_ExistPseudo($pseudo) > 0) {
    $error = 'Pseudo déjà existant';
} elseif (strlen($pseudo) < 6) {
    $error = 'Pseudo trop court';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Email invalide';
} elseif (!empty($exist)) {
    $error = 'Un compte avec cet email existe déjà.';
} elseif (!preg_match($regex, $password)) {
    $error = 'Mot de passe invalide';
} elseif ($password !== $confirm) {
    $error = 'Mots de passe différents';
}

if (isset($error)) {
    header('Location: /views/backend/security/signup.php?error=' . urlencode($error));
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$now  = date('Y-m-d H:i:s');

sql_connect();
global $DB;

$stmt = $DB->prepare(
    'INSERT INTO MEMBRE
    (pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb, dtCreaMemb, dtMajMemb, numStat)
    VALUES (:pseudo, :prenom, :nom, :pass, :email, :dtCrea, NULL, :numStat)'
);

$stmt->execute([
    ':pseudo'  => $pseudo,
    ':prenom'  => $prenom,
    ':nom'     => $nom,
    ':pass'    => $hash,
    ':email'   => $email,
    ':dtCrea'  => $now,
    ':numStat' => $statutMembre
]);

header('Location: /views/backend/security/signup.php?success=' . urlencode('Compte créé avec succès. Vous pouvez vous connecter.'));
exit;
