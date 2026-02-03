<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /views/backend/members/list.php');
    exit;
}

$numMemb = (int)($_POST['numMemb'] ?? 0);

if ($numMemb <= 0) {
    header('Location: /views/backend/members/list.php?error=' . urlencode('Membre invalide'));
    exit;
}

if (empty($_POST['recaptcha_token'])) {
    header('Location: /views/backend/members/delete.php?numMemb=' . $numMemb . '&error=' . urlencode('Captcha manquant'));
    exit;
}

$verify = file_get_contents(
    'https://www.google.com/recaptcha/api/siteverify'
    . '?secret=6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU'
    . '&response=' . $_POST['recaptcha_token']
);

$response = json_decode($verify, true);

if (
    empty($response['success']) ||
    $response['score'] < 0.5 ||
    $response['action'] !== 'member_delete'
) {
    header('Location: /views/backend/members/delete.php?numMemb=' . $numMemb . '&error=' . urlencode('Captcha invalide'));
    exit;
}

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

    header('Location: /views/backend/members/delete.php?numMemb=' . $numMemb . '&error=' . urlencode($msg));
    exit;
}

$rq = $DB->prepare("DELETE FROM MEMBRE WHERE numMemb = :numMemb");
$rq->execute([':numMemb' => $numMemb]);

header('Location: /views/backend/members/list.php?success=' . urlencode('Membre supprimé'));
exit;
