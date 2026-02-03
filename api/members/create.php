<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/getExistPseudo.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = $_POST['pseudoMemb'];
    $prenom = $_POST['prenomMemb'];
    $nom = $_POST['nomMemb'];
    $passwrd = $_POST['passMemb'];
    $passwrdConf = $_POST['passMembConfirm'];
    $email = trim($_POST['eMailMemb']);
    $emailConf = trim($_POST['eMailMembConfirm']);
    $numStat = $_POST['numStat'];
    $accord = $_POST['accordMemb'] ?? '0';
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/';
    $dateCreation = date("Y-m-d H:i:s");
    $dtMajMemb = null;

    if (get_ExistPseudo($pseudo) > 0) {
        $error = "Ce pseudo existe déjà.";
    } elseif (strlen($pseudo) < 6) {
        $error = "Pseudo trop court.";
    } elseif ($email !== $emailConf) {
        $error = "Les emails ne correspondent pas.";
    } elseif (!preg_match($pattern, $passwrd)) {
        $error = "Mot de passe invalide.";
    } elseif ($passwrd !== $passwrdConf) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif ($accord !== '1') {
        $error = "Vous devez accepter le RGPD.";
    } elseif (empty($numStat)) {
        $error = "Statut obligatoire.";
    }

    if (isset($error)) {
        header('Location: ../../views/backend/members/create.php?error=' . urlencode($error));
        exit;
    }

    $passwrd = password_hash($passwrd, PASSWORD_DEFAULT);

    $rq = BDD::get()->prepare("INSERT INTO MEMBRE(pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb, dtCreaMemb, dtMajMemb, numStat) VALUES(:pseudo, :prenom, :nom, :passwrd, :email, :dtCreaMemb, :dtMajMemb, :numStat)");
    $rq->execute([':pseudo' => $pseudo,':prenom' => $prenom,':nom' => $nom,':passwrd' => $passwrd,':email' => $email,':dtCreaMemb' => $dateCreation,':dtMajMemb' => $dtMajMemb,':numStat' => $numStat]);
}

header('Location: ../../views/backend/members/list.php');
exit;
