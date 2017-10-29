<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}

$data = [];

$data['societe'] = $_POST['societe'];
$data['nom'] = $_POST['nom'];
$data['prenom'] = $_POST['prenom'];
$data['mail'] = $_POST['mail'];
$data['tel'] = $_POST['tel'];
$data['cp'] = $_POST['cp'];
$data['ville'] = $_POST['ville'];
$data['adresse'] = $_POST['adresse'];
$data['id'] = $_POST['id'];


$client = new Client();
$client->modify($data);
echo json_encode($data['societe']);
