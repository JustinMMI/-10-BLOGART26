<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt = (int) $_POST['numArt'];

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

/* =========================
   IMAGE (OPTIONNELLE)
========================= */
$imageSql = '';

if (!empty($_FILES['urlPhotArt']['name'])) {
    $fileName = basename($_FILES['urlPhotArt']['name']);
    move_uploaded_file(
        $_FILES['urlPhotArt']['tmp_name'],
        $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $fileName
    );
    $imageSql = ", urlPhotArt = '$fileName'";
}

/* =========================
   UPDATE ARTICLE
========================= */
sql_update(
    'ARTICLE',
    "
    libTitrArt = '$libTitrArt',
    libChapoArt = '$libChapoArt',
    libAccrochArt = '$libAccrochArt',
    parag1Art = '$parag1Art',
    libSsTitr1Art = '$libSsTitr1Art',
    parag2Art = '$parag2Art',
    libSsTitr2Art = '$libSsTitr2Art',
    parag3Art = '$parag3Art',
    libConclArt = '$libConclArt',
    numThem = $numThem
    $imageSql,
    dtMajArt = NOW()
    ",
    "numArt = $numArt"
);

/* =========================
   MOTS-CLÉS (RESET)
========================= */
sql_delete('MOTCLEARTICLE', "numArt = $numArt");

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
