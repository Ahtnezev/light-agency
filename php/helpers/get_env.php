<?php
namespace helpers;

function env($key, $default = null) {
    $value = getenv($key);
    return $value !== false ? $value : $default;
}