<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

/* =========================
   CHAMPS TEXTE
========================= */
$libTitrArt     = addslashes(ctrlSaisies($_POST['libTitrArt']));
$libChapoArt    = addslashes(ctrlSaisies($_POST['libChapoArt']));
$libAccrochArt  = addslashes(ctrlSaisies($_POST['libAccrochArt']));
$parag1Art      = addslashes(ctrlSaisies($_POST['parag1Art']));
$libSsTitr1Art  = addslashes(ctrlSaisies($_POST['libSsTitr1Art']));
$parag2Art      = addslashes(ctrlSaisies($_POST['parag2Art']));
$libSsTitr2Art  = addslashes(ctrlSaisies($_POST['libSsTitr2Art']));
$parag3Art      = addslashes(ctrlSaisies($_POST['parag3Art']));
$libConclArt    = addslashes(ctrlSaisies($_POST['libConclArt']));
$numThem        = (int) $_POST['numThem'];

$fileName = '';

if (!empty($_FILES['urlPhotArt']['name'])) {
    $fileName = basename($_FILES['urlPhotArt']['name']);
    move_uploaded_file(
        $_FILES['urlPhotArt']['tmp_name'],
        $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $fileName
    );
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

$numArt = sql_select("ARTICLE", "MAX(numArt) AS id")[0]['id'];

if (!empty($_POST['mots'])) {
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
