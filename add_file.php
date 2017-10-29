<?php

require_once 'autoload.php';

if (isset($_FILES['doc']) && isset($_POST['id'])) {
    $path = __DIR__ . '/upload/';
    $name = $_FILES['doc']['name'];
    $_FILES['doc']['name'] = rand(0, 100000) . '_' . $_FILES['doc']['name'];
    $res = move_uploaded_file($_FILES['doc']['tmp_name'], $path . $_FILES['doc']['name']);
    $up = new Client();
    $up->addDoc($name, '/reporting/upload/' . $_FILES['doc']['name'],$_POST['id']);
    if ($res) header('location:client.php?id=' . $_POST['id']);
}