<?php

return [
    // Payment Gateway Settings
    'stripe' => [
        'key' => $_ENV['STRIPE_KEY'] ?? null,
        'secret' => $_ENV['STRIPE_SECRET'] ?? null,
        'webhook_secret' => $_ENV['STRIPE_WEBHOOK_SECRET'] ?? null,
    ],
    
    // Google Maps API (for location services)
    'google_maps' => [
        'api_key' => $_ENV['GOOGLE_MAPS_API_KEY'] ?? null,
    ],
    
    // SMS Gateway Settings
    'twilio' => [
        'account_sid' => $_ENV['TWILIO_ACCOUNT_SID'] ?? null,
        'auth_token' => $_ENV['TWILIO_AUTH_TOKEN'] ?? null,
        'from_number' => $_ENV['TWILIO_FROM_NUMBER'] ?? null,
    ],
    
    // Social Media Integration
    'social' => [
        'facebook' => [
            'app_id' => $_ENV['FACEBOOK_APP_ID'] ?? null,
            'app_secret' => $_ENV['FACEBOOK_APP_SECRET'] ?? null,
        ],
        'google' => [
            'client_id' => $_ENV['GOOGLE_CLIENT_ID'] ?? null,
            'client_secret' => $_ENV['GOOGLE_CLIENT_SECRET'] ?? null,
        ],
    ],
    
    // Analytics Services
    'analytics' => [
        'google_analytics_id' => $_ENV['GOOGLE_ANALYTICS_ID'] ?? null,
    ],
]; 