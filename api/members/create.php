<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = $_POST['pseudoMemb'];
    $prenom = $_POST['prenomMemb'];
    $nom = $_POST['nomMemb'];
    $passwrd = $_POST['passMemb'];
    $passwrdConf = $_POST['passMembConfirm']; 
    $email = $_POST['eMailMemb'];
    $emailConf = $_POST['eMailMembConfirm'];
    $dateCreation = date("Y-m-d-H-i-s"); 
    $dtMajMemb = null;
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/';
    $accord = isset($_POST['accordMemb']) ? $_POST['accordMemb'] : '0'; 


    if ($_SESSION['numStat'] != 1) { 
        echo "Vous n'avez pas les droits pour créer un membre.";
        exit;
    }elseif (get_ExistPseudo($pseudo) > 0) {
        $error = "Ce pseudo existe déjà!";
    }elseif (strlen($pseudo)<6){
        $error = "Ce pseudo est trop court!";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !filter_var($emailConf, FILTER_VALIDATE_EMAIL)) {
        $error = "L'adresse email n'est pas valide !";
    }elseif ($email !== $emailConf){
        $error = "Les deux adresses email ne correspondent pas!";
    }elseif (!preg_match($pattern, $passwrd) || !preg_match($pattern, $passwrdConf)) {
        $error = "Le mot de passe doit comporter 8 à 15 caractères, au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
    }elseif ($passwrd !== $passwrdConf){
        $error = "Les deux mots de passe ne correspondent pas!";
    }elseif ($accord !== '1') {
        $error = "Vous devez accepter la conservation de vos données pour créer un compte.";
    }else {
        $passwrd = password_hash($_POST['passMemb'], PASSWORD_DEFAULT);
        $rq = BDD::get()->prepare("INSERT INTO MEMBRE (pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb, dtCreaMemb, dtMajMemb) VALUES (:pseudo, :prenom, :nom, :passwrd, :email, :dateCreation, :dtMajMemb)");
        $rq->execute([':pseudo' => $pseudo,':prenom' => $prenom,':nom' => $nom,':passwrd' => $passwrd,':email' => $email,':dtCreaMemb' => $dateCreation, ':dtMajMemb' => $dtMajMemb]);
    }
}


header('Location: ../../views/backend/members/list.php');
?>