<?php

return [
    'name' => env('APP_NAME', 'Projects App'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
    'log' => env('APP_LOG', 'daily'),
    'log_level' => env('APP_LOG_LEVEL', 'debug'),
    'providers' => [
        // Laravel Framework Service Providers...
        // Other Service Providers...
    ],
    'aliases' => [
        // Class aliases...
    ],
];
