<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

session_start();

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

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $error = '';

    if (empty($_POST['g-recaptcha-response'])) {
        $error = "Captcha requis.";
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

    if ($error) {
        header('Location: ../../views/backend/members/delete.php?numMemb=' . urlencode($_POST['numMemb']) . '&error=' . urlencode($error));
        exit;
    }

    $numMemb = $_POST['numMemb'] ?? null;

    if ($numMemb) {
        sql_connect();
        global $DB;

        $rqComments = $DB->prepare("SELECT COUNT(*) FROM COMMENTAIRE WHERE numMemb = :numMemb");
        $rqComments->execute([':numMemb' => $numMemb]);
        $commentCount = $rqComments->fetchColumn();

        $rqLikes = $DB->prepare("SELECT COUNT(*) FROM `LIKE` WHERE numMemb = :numMemb");
        $rqLikes->execute([':numMemb' => $numMemb]);
        $likeCount = $rqLikes->fetchColumn();

        if ($commentCount > 0 || $likeCount > 0) {
            $msg = "Impossible de supprimer le membre. Supprimez d'abord ses ";
            if ($commentCount > 0) $msg .= "commentaires ";
            if ($likeCount > 0) $msg .= ($commentCount > 0 ? "et " : "") . "likes";
            header('Location: ../../views/backend/members/delete.php?numMemb=' . urlencode($numMemb) . '&error=' . urlencode($msg));
            exit;
        }

        $sql = "DELETE FROM MEMBRE WHERE numMemb = :numMemb";
        $rq = $DB->prepare($sql);
        $rq->execute([':numMemb' => $numMemb]);
    }
}

header('Location: ../../views/backend/members/list.php');
exit;
