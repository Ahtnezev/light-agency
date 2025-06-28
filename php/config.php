<?php

require_once __DIR__ . '/load_env.php';
require_once __DIR__ . '/helpers/get_env.php';

loadEnv(__DIR__ . '/../.env');
use function helpers\env;

define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets');

define('ROOT_PATH', dirname(__DIR__, 1));
define('BASENAME_PATH', basename(ROOT_PATH));

define('VIEWS_PATH', ROOT_PATH . '/public_html/views');
define('PARTIALS_PATH', VIEWS_PATH . '/partials');

// environment variables
define('DB_HOST', env('DB_HOST'));
define('DB_PORT', env('DB_PORT'));
define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASS', env('DB_PASS'));

// show errors
ini_set('display_errors', 1);
error_reporting(E_ALL);
