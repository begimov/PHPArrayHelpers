<?php

namespace App\Helpers;

use ArrayAccess;

class ArrayHelpers
{
    public static function isAccessible($obj)
    {
        return is_array($obj) || $obj instanceof ArrayAccess;
    }

    public static function get($arr, $prop = null, $default = null)
    {
        if (!static::isAccessible($arr) || !$arr || !$prop) {
            return null;
        }
        $iter = function ($arr, $propArr) use (&$iter, $default) {
            if (!$arr || !$propArr) {
                return $arr;
            }
            if (!static::isAccessible($arr)) {
                return $default;
            }
            return (array_key_exists($propArr[0], $arr))
                ? $iter($arr[$propArr[0]], array_slice($propArr, 1))
                : $default;
        };
        return $iter($arr, explode('.', trim($prop)));
    }
}
