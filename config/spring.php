<?php

// config for Nddcoder/LaravelSpring
return [
    'scan_folders'                       => [
        'app' => '\App'
    ],
    'fallback_bean_to_laravel_container' => env('FALLBACK_BEAN_TO_LARAVEL_CONTAINER', true)
];
