<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/ctrlSaisies.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

$libTitrArt     = addslashes(ctrlSaisies($_POST['libTitrArt'] ?? ''));
$libChapoArt    = addslashes(ctrlSaisies($_POST['libChapoArt'] ?? ''));
$libAccrochArt  = addslashes(ctrlSaisies($_POST['libAccrochArt'] ?? ''));
$parag1Art      = addslashes(ctrlSaisies($_POST['parag1Art'] ?? ''));
$libSsTitr1Art  = addslashes(ctrlSaisies($_POST['libSsTitr1Art'] ?? ''));
$parag2Art      = addslashes(ctrlSaisies($_POST['parag2Art'] ?? ''));
$libSsTitr2Art  = addslashes(ctrlSaisies($_POST['libSsTitr2Art'] ?? ''));
$parag3Art      = addslashes(ctrlSaisies($_POST['parag3Art'] ?? ''));
$libConclArt    = addslashes(ctrlSaisies($_POST['libConclArt'] ?? ''));
$numThem        = (int) ($_POST['numThem'] ?? 0);

$uploadDir   = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
$placeholder = 'placeholder-article.jpg';
$fileName    = $placeholder;

// Upload image si fournie
if (
    !empty($_FILES['urlPhotArt']['name']) &&
    $_FILES['urlPhotArt']['error'] === UPLOAD_ERR_OK
) {
    $tmpName = $_FILES['urlPhotArt']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['urlPhotArt']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $allowed, true)) {
        $fileName = uniqid('art_', true) . '.' . $ext;
        move_uploaded_file($tmpName, $uploadDir . $fileName);
    }
}

sql_insert(
    'ARTICLE',
    '
        libTitrArt, libChapoArt, libAccrochArt,
        parag1Art, libSsTitr1Art, parag2Art,
        libSsTitr2Art, parag3Art, libConclArt,
        urlPhotArt, numThem, dtCreaArt
    ',
    "
        '$libTitrArt', '$libChapoArt', '$libAccrochArt',
        '$parag1Art', '$libSsTitr1Art', '$parag2Art',
        '$libSsTitr2Art', '$parag3Art', '$libConclArt',
        '$fileName', $numThem, NOW()
    "
);

$numArt = sql_select(
    "ARTICLE",
    "MAX(numArt) AS id"
)[0]['id'] ?? 0;

if ($numArt && !empty($_POST['mots']) && is_array($_POST['mots'])) {
    foreach ($_POST['mots'] as $numMotCle) {
        $numMotCle = (int) $numMotCle;
        sql_insert(
            'MOTCLEARTICLE',
            'numArt, numMotCle',
            "$numArt, $numMotCle"
        );
    }
}

header('Location: ../../views/backend/articles/list.php');
exit;
