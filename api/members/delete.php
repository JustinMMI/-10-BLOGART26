<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
        header('Location: ../../views/backend/members/delete.php?numMemb=' . urlencode($_POST['numMemb']) . '&error=' . urlencode($error));
        exit;
    }

    $numMemb = $_POST['numMemb'] ?? null;

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
