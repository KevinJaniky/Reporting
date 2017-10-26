<?php
require_once 'autoload.php';
session_destroy();
header('location:index.php');