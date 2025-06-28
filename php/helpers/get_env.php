<?php
namespace helpers;

function env(string $key, $default = null)
{
    return $_ENV[$key] ?? $default;
}