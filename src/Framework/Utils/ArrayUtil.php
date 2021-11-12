<?php

namespace Framework\Utils;

class ArrayUtil
{
    public static function exists(array $array, string $key): bool
    {
        return array_key_exists($key, $array);
    }

    public static function set(array &$array, string $key, $value): array
    {
        $array[$key] = $value;

        return $array;
    }

    public static function get(array $array, string $key, $default = null)
    {
        if (static::exists($array, $key)) {
            return $array[$key];
        }

        return $default;
    }
}
