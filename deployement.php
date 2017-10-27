<?php

require_once 'autoload.php';

$dep = new Deployement();
$dep->createTable();
$dep->seederTable();

header('location:dashboard.php');