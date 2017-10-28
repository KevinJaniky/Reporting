<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $report = new Reporte();
    $report->deleteOne($id);
}