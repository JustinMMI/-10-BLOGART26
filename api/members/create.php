<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/getExistPseudo.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /views/backend/members/list.php');
    exit;
}

if (empty($_POST['recaptcha_token'])) {
    header('Location: /views/backend/members/create.php?error=' . urlencode('Captcha manquant'));
    exit;
}

$verify = file_get_contents(
    'https://www.google.com/recaptcha/api/siteverify'
    . '?secret=' . "6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU"
    . '&response=' . $_POST['recaptcha_token']
);

$response = json_decode($verify, true);

if (
    empty($response['success']) ||
    $response['score'] < 0.5 ||
    $response['action'] !== 'member_create' ||
    $response['hostname'] !== $_SERVER['SERVER_NAME']
) {
    header('Location: /views/backend/members/create.php?error=' . urlencode('Captcha invalide'));
    exit;
}

$pseudo = trim($_POST['pseudoMemb']);
$prenom = trim($_POST['prenomMemb']);
$nom = trim($_POST['nomMemb']);
$pass = $_POST['passMemb'];
$passConf = $_POST['passMembConfirm'];
$email = trim($_POST['eMailMemb']);
$emailConf = trim($_POST['eMailMembConfirm']);
$numStat = $_POST['numStat'] ?? null;
$accord = $_POST['accordMemb'] ?? '0';
$exist = sql_select("MEMBRE", "*", "eMailMemb = '$email'");
$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/';

if (get_ExistPseudo($pseudo) > 0) {
    $error = 'Pseudo déjà existant';
} elseif (strlen($pseudo) < 6) {
    $error = 'Pseudo trop court';
} elseif ($email !== $emailConf) {
    $error = 'Emails différents';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Email invalide';
} elseif (!preg_match($regex, $pass)) {
    $error = 'Mot de passe invalide';
} elseif ($pass !== $passConf) {
    $error = 'Mots de passe différents';
} elseif ($accord !== '1') {
    $error = 'RGPD requis';
} elseif (empty($numStat)) {
    $error = 'Statut requis';
}elseif (!empty($exist)) {
    $error = "Un compte avec cet email existe déjà.";
} 

if (isset($error)) {
    header('Location: /views/backend/members/create.php?error=' . urlencode($error));
    exit;
}

$hash = password_hash($pass, PASSWORD_DEFAULT);
$now = date('Y-m-d H:i:s');

sql_connect();
global $DB;

$stmt = $DB->prepare(
    'INSERT INTO MEMBRE
    (pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb, dtCreaMemb, dtMajMemb, numStat)
    VALUES (:pseudo, :prenom, :nom, :pass, :email, :dtCrea, NULL, :numStat)'
);

$stmt->execute([
    ':pseudo' => $pseudo,
    ':prenom' => $prenom,
    ':nom' => $nom,
    ':pass' => $hash,
    ':email' => $email,
    ':dtCrea' => $now,
    ':numStat' => $numStat
]);

header('Location: /views/backend/members/list.php?success=' . urlencode('Membre créé'));
exit;
