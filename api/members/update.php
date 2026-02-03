<?php
require_once '../../config.php'; 
require_once '../../functions/query/update.php'; 
require_once '../../functions/query/select.php';

if (empty($_POST['recaptcha_token'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=' . urlencode('Captcha manquant'));
    exit;
}

$token = $_POST['recaptcha_token'];

$verify = file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret=" . "6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU" . "&response=" . $token
);

$response = json_decode($verify, true);

if (
    empty($response['success']) ||
    $response['score'] < 0.5 ||
    $response['action'] !== 'member_create' ||
    $response['hostname'] !== $_SERVER['SERVER_NAME']
) {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=' . urlencode('Captcha invalide'));
    exit;
}
if (empty($_POST['recaptcha-response'])) {
    die("Erreur : Captcha manquant.");
}

$url = 'https://www.google.com/recaptcha/api/siteverify';
$secret = 'TA_CLE_SECRETE_ICI'; 
$response = $_POST['recaptcha-response'];
$verify = file_get_contents($url . '?secret=' . $secret . '&response=' . $response);
$captcha_data = json_decode($verify);

if (!$captcha_data->success || $captcha_data->score < 0.5) {
    die("Erreur : Vous êtes détecté comme un robot.");
}

$numMemb = $_POST['numMemb'];
$prenom = htmlspecialchars($_POST['prenomMemb']);
$nom = htmlspecialchars($_POST['nomMemb']);
$numStat = $_POST['numStat'];
$email = $_POST['eMailMemb'];
$emailConf = $_POST['eMailMembConf'];
$pass = $_POST['passMemb'];
$passConf = $_POST['passMembConf'];

$currentMemb = sql_select("MEMBRE", "*", "numMemb = $numMemb")[0];
if (!$currentMemb) die("Membre introuvable.");

$finalEmail = $currentMemb['eMailMemb']; 
if ($email != $currentMemb['eMailMemb']) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erreur : Format email invalide.");
    }
    if ($email !== $emailConf) {
        die("Erreur : Les deux emails ne correspondent pas.");
    }
    $check = sql_select("MEMBRE", "numMemb", "eMailMemb = '$email' AND numMemb != $numMemb");
    if (count($check) > 0) {
        die("Erreur : Cet email est déjà utilisé.");
    }
    $finalEmail = $email;
}

$finalPass = $currentMemb['passMemb']; 

if (!empty($pass)) {
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,15}$/';
    
    if (!preg_match($regex, $pass)) {
        die("Erreur : Le mot de passe doit faire 8 à 15 caractères, avec Majuscule, minuscule et chiffre.");
    }
    if ($pass !== $passConf) {
        die("Erreur : Les mots de passe ne correspondent pas.");
    }
    $finalPass = password_hash($pass, PASSWORD_DEFAULT);
}

$dtModif = date("Y-m-d H:i:s");

update(
    "MEMBRE", 
    ["prenomMemb", "nomMemb", "eMailMemb", "passMemb", "numStat", "dtModifMemb"], 
    [$prenom, $nom, $finalEmail, $finalPass, $numStat, $dtModif], 
    "numMemb = $numMemb"
);

header('Location: ../../views/backend/members/list.php');
exit();
?>