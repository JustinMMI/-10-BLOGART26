<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/getExistPseudo.php';

session_start();

// 🔐 Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = $_POST['pseudoMemb'];
    $prenom = $_POST['prenomMemb'];
    $nom = $_POST['nomMemb'];
    $passwrd = $_POST['passMemb'];
    $passwrdConf = $_POST['passMembConfirm'];
    $email = trim($_POST['eMailMemb']);
    $emailConf = trim($_POST['eMailMembConfirm']);
    $numStat = $_POST['numStat'];
    $accord = $_POST['accordMemb'] ?? '0';
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/';
    $dateCreation = date("Y-m-d H:i:s");
    $dtMajMemb = null;

    if (get_ExistPseudo($pseudo) > 0) {
        $error = "Ce pseudo existe déjà.";
    } elseif (strlen($pseudo) < 6) {
        $error = "Pseudo trop court.";
    } elseif ($email !== $emailConf) {
        $error = "Les emails ne correspondent pas.";
    } elseif (!preg_match($pattern, $passwrd)) {
        $error = "Mot de passe invalide.";
    } elseif ($passwrd !== $passwrdConf) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif ($accord !== '1') {
        $error = "Vous devez accepter le RGPD.";
    } elseif (empty($numStat)) {
        $error = "Statut obligatoire.";
    }

    if (isset($error)) {
        header('Location: ../../views/backend/members/create.php?error=' . urlencode($error));
        exit;
    }

    $passwrd = password_hash($passwrd, PASSWORD_DEFAULT);

    $error = '';

    if (empty($_POST['g-recaptcha-response'])) {
        $error = "Captcha requis.";
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
    
    $numMemb = $_GET['numMemb'] ?? null;

    if ($numMemb) {
        sql_connect();
        global $DB;

        $sql = "DELETE FROM MEMBRE WHERE numMemb = :numMemb";
        $rq = $DB->prepare($sql);
        $rq->execute([':numMemb' => $numMemb]);
    }


}

header('Location: ../../views/backend/members/list.php');
exit;
