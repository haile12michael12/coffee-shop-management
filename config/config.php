<?php

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'coffee_shop');

// Application configuration
define('APP_NAME', 'Coffee Shop Management');
define('APP_VERSION', '1.0.0');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session configuration
//ini_set('session.cookie_httponly', 1);
//ini_set('session.use_only_cookies', 1);
//ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS

// Time zone
date_default_timezone_set('UTC');

define('BASE_URL', 'http://localhost/coffee-shop-management');
define('SITE_NAME', 'Coffee Management System');
define('DEFAULT_ROLE', 'staff');
define('ADMIN_ROLE', 'admin');
?>