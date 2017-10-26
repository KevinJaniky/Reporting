<?php

session_start();

function __autoload($class_name)
{
    include 'class/' . $class_name . '.php';
}
