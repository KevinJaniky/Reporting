<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}

if (isset($_POST['com']) && isset($_POST['comp']) && isset($_POST['date']) && isset($_POST['title'])) {
    $report = new Reporte();
    $report->setDate($_POST['date']);
    $report->setCompetence((int)$_POST['comp']);
    $report->setCommentaire($_POST['com']);
    $report->setTitre($_POST['title']);

    $res = $report->create($_SESSION['id']);
    if($res){
        header('location:dashboard.php');
        die();
    }else {
        $_SESSION['error_reporting'] = $res;
    }

}