<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $client = new Client();
    $data = $client->search($search);
    echo json_encode($data);

}