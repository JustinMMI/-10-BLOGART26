<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/update.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('page');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /views/backend/members/list.php');
    exit;
}

$numMemb = (int)($_POST['numMemb'] ?? 0);

if ($numMemb <= 0) {
    header('Location: /views/backend/members/list.php');
    exit;
}

if (empty($_POST['recaptcha_token'])) {
    header('Location: /views/backend/members/edit.php?numMemb=' . $numMemb . '&error=' . urlencode('Captcha manquant'));
    exit;
}

$verify = file_get_contents(
    'https://www.google.com/recaptcha/api/siteverify'
    . '?secret=' . '6LewKl8sAAAAAMPDkHvKgCdyW8eiLqYKuUhglsQU'
    . '&response=' . $_POST['recaptcha_token']
);

$response = json_decode($verify, true);

if (
    empty($response['success']) ||
    $response['score'] < 0.5 ||
    $response['action'] !== 'member_update' ||
    $response['hostname'] !== $_SERVER['SERVER_NAME']
) {
    header('Location: /views/backend/members/edit.php?numMemb=' . $numMemb . '&error=' . urlencode('Captcha invalide'));
    exit;
}

$membre = sql_select('MEMBRE', '*', 'numMemb = ' . $numMemb)[0] ?? null;

if (!$membre) {
    header('Location: /views/backend/members/list.php?error=' . urlencode('Membre introuvable'));
    exit;
}

$prenom    = trim($_POST['prenomMemb'] ?? '');
$nom       = trim($_POST['nomMemb'] ?? '');
$numStat   = (int)($_POST['numStat'] ?? 0);
$email     = trim($_POST['eMailMemb'] ?? '');
$emailConf = trim($_POST['eMailMembConf'] ?? '');
$pass      = $_POST['passMemb'] ?? '';
$passConf  = $_POST['passMembConf'] ?? '';

$finalEmail = $membre['eMailMemb'];

if ($email !== $membre['eMailMemb']) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email invalide';
    } elseif ($email !== $emailConf) {
        $error = 'Emails différents';
    } else {
        $check = sql_select(
            'MEMBRE',
            'numMemb',
            "eMailMemb = " . $DB->quote($email) . " AND numMemb != $numMemb"
        );
        if (!empty($check)) {
            $error = 'Email déjà utilisé';
        } else {
            $finalEmail = $email;
        }
    }
}

$finalPass = $membre['passMemb'];

$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/';

if (!empty($pass)) {
    if (!preg_match($regex, $pass)) {
        $error = 'Mot de passe invalide';
    } elseif ($pass !== $passConf) {
        $error = 'Mots de passe différents';
    } else {
        $finalPass = password_hash($pass, PASSWORD_DEFAULT);
    }
}

if (isset($error)) {
    header('Location: /views/backend/members/edit.php?numMemb=' . $numMemb . '&error=' . urlencode($error));
    exit;
}

$now = date('Y-m-d H:i:s');

$set = "
    prenomMemb = " . $DB->quote($prenom) . ",
    nomMemb    = " . $DB->quote($nom) . ",
    eMailMemb  = " . $DB->quote($finalEmail) . ",
    passMemb   = " . $DB->quote($finalPass) . ",
    numStat    = $numStat,
    dtMajMemb  = " . $DB->quote($now) . "
";

sql_update(
    'MEMBRE',
    $set,
    'numMemb = ' . $numMemb
);

header('Location: /views/backend/members/list.php?success=' . urlencode('Membre mis à jour'));
exit;
