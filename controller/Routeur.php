<?php

require_once File::build_path(array('controller',"ControllerAdministration.php"));
require_once File::build_path(array('controller',"ControllerHome.php"));
require_once File::build_path(array('controller',"ControllerUser.php"));
require_once (File::build_path(array('lib', 'Security.php')));

if (isset($_COOKIE['basket'])) {
    $tab_basket = unserialize($_COOKIE['basket']);
    $_SESSION['basket'] = $tab_basket;
}

function myGet($nomvar) {
    if (isset($_GET[$nomvar])) {
    return $_GET[$nomvar];
    } else if (isset($_POST[$nomvar])) {
        return $_POST[$nomvar];
    } else {
        return NULL;
    }
}

if (myGet('controller') !== NULL) {
    $controller_class = 'Controller' . myGet('controller');
} else {
    $controller_class =  'ControllerHome';
}

$array = array("controller", $controller_class);

if (class_exists($controller_class)) {
    $class_methods = get_class_methods($controller_class);
    if (myGet('action') !== NULL) {
        $action = myGet('action');
        if (in_array($action, $class_methods)) {
            $controller_class::$action();
        } else {
            ControllerUser::error();
        }
    } else {
        ControllerHome::buildFrontPage();
    }
} else {
    ControllerHome::buildFrontPage();
}

?>
