<?php


class Utils
{
    public function typeof($var)
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

    function arrayToString($arr)
    {
        return '[' . join(', ', $arr) . ']';
    }

    function assocArrayToString($assoc_array)
    {
        $string_array = array_map(function ($key, $value) {
            return "$key => $value";
        }, array_keys($assoc_array), $assoc_array);
        return '[' . join(', ', $string_array) . ']';
    }
}
