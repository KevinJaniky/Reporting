<?php
require_once 'autoload.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
session_destroy();
header('location:index.php');