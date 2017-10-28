<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
$pros = new Prospection();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $data = $pros->readOne($id);
    if ($data) {
        $client = new Client();
        if ($client->findClientByMail($data['mail'])) {
            $client->prospectToClient($data, $_SESSION['id']);
            $data = $client->findId($data['mail']);
            echo json_encode($data);
        }else{
            echo json_encode(['error'=>'exist']);
        }
    }
}
