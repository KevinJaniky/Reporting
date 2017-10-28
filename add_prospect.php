<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
if(isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['tel']) && isset($_POST['adresse'])
&& isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['com'])){

    $prospect = new Prospection();
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    $commentaire = $_POST['com'];

    $prospect->setNom($nom);
    $prospect->setMail($mail);
    $prospect->setTel($tel);
    $prospect->setAdress($adresse);
    $prospect->setCp($cp);
    $prospect->setVille($ville);
    $prospect->setCom($commentaire);

    $prospect->create($_SESSION['id']);
    header('location:prospect.php');
    die();
}


