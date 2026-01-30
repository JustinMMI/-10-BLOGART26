<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// 🔐 Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

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

if ($error) {
    header('Location: ../../views/backend/members/list.php');
    exit;
}

$numMemb = (int) $_POST['numMemb'];

sql_update(
    "MEMBRE",
    "pseudoMemb = 'Utilisateur supprimé',
     eMailMemb = CONCAT('deleted_', numMemb, '@local'),
     passMemb = '',
     numStat = 999",
    "numMemb = $numMemb"
);

header('Location: ../../views/backend/members/list.php');
exit;
