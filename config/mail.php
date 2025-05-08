<?php

return [
    'default' => 'smtp',
    
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => $_ENV['MAIL_HOST'] ?? 'smtp.mailtrap.io',
            'port' => $_ENV['MAIL_PORT'] ?? 2525,
            'encryption' => $_ENV['MAIL_ENCRYPTION'] ?? 'tls',
            'username' => $_ENV['MAIL_USERNAME'] ?? null,
            'password' => $_ENV['MAIL_PASSWORD'] ?? null,
            'timeout' => null,
            'auth_mode' => null,
        ],
    ],
    
    'from' => [
        'address' => $_ENV['MAIL_FROM_ADDRESS'] ?? 'noreply@coffeeshop.com',
        'name' => $_ENV['MAIL_FROM_NAME'] ?? 'Coffee Shop Management System',
    ],
    
    'markdown' => [
        'theme' => 'default',
        'paths' => [
            'App/Views/emails',
        ],
    ],
]; 