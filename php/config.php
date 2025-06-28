<?php

require_once __DIR__ . '/helpers/index.php';
require_once __DIR__ . '/load_env.php';
require_once __DIR__ . '/helpers/get_env.php';

loadEnv(__DIR__ . '/../.env');
use function helpers\env;

if (!defined('DB_HOST')) define('DB_HOST', env('DB_HOST', '127.0.0.1'));
if (!defined('DB_PORT')) define('DB_PORT', env('DB_PORT', '3306'));
if (!defined('DB_NAME')) define('DB_NAME', env('DB_NAME', 'light_agency_db'));
if (!defined('DB_USER')) define('DB_USER', env('DB_USER', 'root'));
if (!defined('DB_PASS')) define('DB_PASS', env('DB_PASS', ''));

// debug
// var_dump(DB_HOST, DB_NAME, DB_USER, DB_PASS); exit;

if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}
if (!defined('ASSETS_URL')) {
    define('ASSETS_URL', BASE_URL . 'assets');
}
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 1));
}
if (!defined('BASENAME_PATH')) {
    define('BASENAME_PATH', basename(ROOT_PATH));
}
if (!defined('VIEWS_PATH')) {
    define('VIEWS_PATH', ROOT_PATH . '/public_html/views');
}
if (!defined('PARTIALS_PATH')) {
    define('PARTIALS_PATH', VIEWS_PATH . '/partials');
}

// show errors
ini_set('display_errors', 1);
error_reporting(E_ALL);
