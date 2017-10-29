<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
    $client = new Client();
    $client->modifyCom($_POST['text'],$_POST['id']);
    echo json_encode("Successs");
