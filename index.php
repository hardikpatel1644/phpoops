<?php

require_once 'model/db.php';

if (isset($_GET['controller']) && isset($_GET['action']))
{
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}
else
{
    $controller = 'student';
    $action = 'manage';
}

require_once('views/layout.php');
