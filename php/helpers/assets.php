<?php
namespace helpers;
require __DIR__ . '/../config.php';

function asset($path) {
    return BASE_URL . 'assets/' . ltrim($path, '/');
}