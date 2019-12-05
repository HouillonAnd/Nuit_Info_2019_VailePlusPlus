<?php
require_once File::build_path(array('controller', 'ControllerUser.php'));


$default = "user";

if (array_key_exists('controller', $_GET)) {
    $controller = 'Controller'. ucfirst($_GET['controller']);
} else {
    $controller='Controller'. ucfirst($default);
}

if (class_exists($controller) && array_key_exists('action', $_GET) && in_array($_GET['action'], get_class_methods(new $controller()))) {
    $action = $_GET['action'];
    $controller::$action();
} else {
    $obj="general";
    $view = 'Temp';
    $pagetitle = 'Bienvenue';
    require File::build_path(array('view', 'View.php'));
    //$controller::readAll();
}

function universalGet($key) {
    if(isset($_GET[$key])) {
        return $_GET[$key];
    } else if(isset($_POST[$key])) {
        return $_POST[$key];
    }
}
?>
