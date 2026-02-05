<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('api');

$numArt = (int) $_POST['numArt'];

// supprimer liaisons mots-clés
sql_delete('MOTCLEARTICLE', "numArt = $numArt");

// supprimer article
sql_delete('ARTICLE', "numArt = $numArt");

header('Location: ../../views/backend/articles/list.php');
exit;
