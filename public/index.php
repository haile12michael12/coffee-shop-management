<?php
require_once '../config/constants.php';
require_once '../config/database.php';

// Autoload controllers and models
spl_autoload_register(function ($class) {
    $file = '../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Start session
session_start();

// Parse URL
$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard/index';
$url = explode('/', $url);

// Route handling
$controllerName = ucfirst($url[0]) . 'Controller';
$methodName = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Check if controller and method exist
if (file_exists("../app/controllers/$controllerName.php")) {
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], $params);
    } else {
        require_once '../app/views/errors/404.php';
    }
} else {
    require_once '../app/views/errors/404.php';
}
?>