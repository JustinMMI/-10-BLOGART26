<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Sécurisation basique
$libTitrArt  = ctrlSaisies($_POST['libTitrArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$numThem     = (int) $_POST['numThem'];
$urlPhotArt  = ctrlSaisies($_POST['urlPhotArt']);

sql_insert(
    'ARTICLE',
    'libTitrArt, libChapoArt, numThem, urlPhotArt, dtCreaArt',
    "'$libTitrArt', '$libChapoArt', $numThem, '$urlPhotArt', NOW()"
);

// Redirection après succès
header('Location: ../../views/backend/articles/list.php');
exit;
