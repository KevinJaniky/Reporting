<?php

require_once 'autoload.php';
$client = new Client();
$search = "t";
$data = $client->search($search);
var_dump($data);