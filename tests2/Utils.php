<?php


class Utils
{
    public static function typeof($var): string
    {
        if (is_object($var)) {
            return get_class($var);
        } else if (is_array($var)) {
            if (array_keys($var) !== range(0, count($var) - 1)) {
                return 'associative array of ' . count($var) . ' kv pairs';
            } else {
                return 'array of ' . count($var) . ' elements';
            }
        } else if (is_string($var)) {
            return 'string of ' . strlen($var) . ' chars';
        } else {
            return gettype($var);
        }
    }

    public static function toString($var): string
    {
        if (is_object($var)) {
            $assocArray = get_object_vars($var);
            return Utils::toString($assocArray);
        } else if (is_array($var)) {
            if (array_keys($var) !== range(0, count($var) - 1)) {
                $string_array = array_map(function ($key, $value) {
                    return "$key => $value";
                }, array_keys($var), $var);
                return '[' . join(', ', $string_array) . ']';
            } else {
                return '[' . join(', ', $var) . ']';
            }
        } else {
            return (string) $var;
        }
    }
}
