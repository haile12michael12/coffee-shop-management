<?php
session_start();

// Define base path and URL
define('BASEPATH', __DIR__);
define('APPURL', 'http://localhost/upwork/coffee-shop-management');

// Load configuration
require_once BASEPATH . '/config/config.php';

// Load database connection
require_once BASEPATH . '/config/database.php';

// Load helper functions
require_once BASEPATH . '/helpers/functions.php';

// Autoload classes
spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $class = str_replace('\\', '/', $class);
    $file = BASEPATH . '/' . $class . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

// Get the URL path
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];
$base_path = dirname($script_name);

// Remove base path from request URI
$path = substr($request_uri, strlen($base_path));
$path = parse_url($path, PHP_URL_PATH);

// Remove leading and trailing slashes
$path = trim($path, '/');

// Split the path into segments
$segments = explode('/', $path);

// Default controller and method
$controller = 'HomeControllers';
$method = 'index';
$params = [];

// If we have segments, use them to determine controller and method
if (!empty($segments[0])) {
    $controller = ucfirst($segments[0]) . 'Controllers';
    if (isset($segments[1])) {
        $method = $segments[1];
        // Any remaining segments are parameters
        $params = array_slice($segments, 2);
    }
}

// Create controller instance
$controller_class = "App\\Controllers\\{$controller}";
if (class_exists($controller_class)) {
    $controller_instance = new $controller_class();
    
    // Check if method exists
    if (method_exists($controller_instance, $method)) {
        // Call the method with parameters
        call_user_func_array([$controller_instance, $method], $params);
    } else {
        // Method not found
        header("HTTP/1.0 404 Not Found");
        echo "404 - Method not found";
    }
} else {
    // Controller not found
    header("HTTP/1.0 404 Not Found");
    echo "404 - Controller not found";
} 