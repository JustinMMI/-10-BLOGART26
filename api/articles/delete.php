<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$numArt = (int) $_POST['numArt'];

// supprimer liaisons mots-clés
sql_delete('MOTCLEARTICLE', "numArt = $numArt");

// supprimer article
sql_delete('ARTICLE', "numArt = $numArt");

header('Location: ../../views/backend/articles/list.php');
exit;
