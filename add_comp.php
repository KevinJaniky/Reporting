<?php
require_once 'autoload.php';

if (isset($_POST['com']) && isset($_POST['comp']) && isset($_POST['date'])) {
    $report = new Reporte();
    $report->setDate($_POST['date']);
    $report->setCompetence((int)$_POST['comp']);
    $report->setCommentaire($_POST['com']);
    $res = $report->create();
    if($res){
        header('location:dashboard.php');
        die();
    }else {
        $_SESSION['error_reporting'] = $res;
    }

}