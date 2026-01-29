<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt      = (int) $_POST['numArt'];
$libTitrArt  = ctrlSaisies($_POST['libTitrArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$numThem     = (int) $_POST['numThem'];
$urlPhotArt  = ctrlSaisies($_POST['urlPhotArt']);

sql_update(
    'ARTICLE',
    "libTitrArt = '$libTitrArt',
     libChapoArt = '$libChapoArt',
     numThem = $numThem,
     urlPhotArt = '$urlPhotArt',
     dtMajArt = NOW()",
    "numArt = $numArt"
);

header('Location: ../../views/backend/articles/list.php');
exit;
