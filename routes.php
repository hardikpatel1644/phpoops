<?php

function __autoload($controller)
{
    $ssModelName = ucfirst($controller);
    require_once('model/' . $ssModelName . '.php');
}

function call($controller, $action)
{
    require_once('controllers/' . $controller . '_controller.php');
    switch ($controller)
    {
        case 'student':
            $controller = new StudentController();
            break;
    }

    $controller->{ $action }();
}

// we're adding an entry for the new controller and its actions
$controllers = array('student' => ['manage','error','delete','edit','add']);

if (array_key_exists($controller, $controllers))
{
    if (in_array($action, $controllers[$controller]))
    {
        call($controller, $action);
    }
    else
    {
        call('student', 'error');
    }
}
else
{
    call('student', 'error');
}
?>