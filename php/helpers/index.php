<?php
require_once __DIR__ . '/../load_env.php';
require_once __DIR__ . '/get_env.php';
require_once __DIR__ . '/assets.php';
require_once __DIR__ . '/layout.php';

loadEnv(__DIR__ . '/../../.env');

if (!function_exists('e')) {
    function e($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}