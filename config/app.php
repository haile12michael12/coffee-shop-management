<?php

return [
    // Application Settings
    'name' => 'Coffee Shop Management System',
    'version' => '1.0.0',
    'timezone' => 'UTC',
    'locale' => 'en',
    
    // Session Settings
    'session' => [
        'lifetime' => 120, // minutes
        'expire_on_close' => false,
        'encrypt' => false,
        'cookie' => 'coffee_shop_session',
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'http_only' => true,
    ],
    
    // Security Settings
    'security' => [
        'password_hash_algo' => PASSWORD_BCRYPT,
        'password_hash_options' => [
            'cost' => 12
        ],
        'token_lifetime' => 60, // minutes
    ],
    
    // File Upload Settings
    'upload' => [
        'max_size' => 5242880, // 5MB
        'allowed_types' => ['jpg', 'jpeg', 'png', 'gif'],
        'upload_path' => 'public/uploads/',
    ],
    
    // Pagination Settings
    'pagination' => [
        'per_page' => 10,
        'max_pages' => 5,
    ],
    
    // Cache Settings
    'cache' => [
        'enabled' => true,
        'driver' => 'file',
        'path' => 'storage/cache/',
        'lifetime' => 60, // minutes
    ],
]; 