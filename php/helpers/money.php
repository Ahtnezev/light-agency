<?php

namespace helpers;

use Exception;

class Money {
    public static function toMXN($value = 0) : string {
        if (!is_numeric($value)) {
            throw new Exception('Value not valid');
        }
        return number_format($value, 2);
    }
}