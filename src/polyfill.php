<?php
/**
 * Polyfill: array_column
 */
if (!function_exists('array_column')) {
    /**
     * Return the values from a single column in the input array
     *
     * array_column() returns the values from a single column of the array, identified by the column_key. Optionally, an index_key may be provided to index the values in the returned array by the values from the index_key column of the input array.
     *
     * @param array $array A multi-dimensional array or an array of objects from which to pull a column of values from. If an array of objects is provided, then public properties can be directly pulled. In order for protected or private properties to be pulled, the class must implement both the __get() and __isset() magic methods.
     * @param int|string|null $column_key The column of values to return. This value may be an integer key of the column you wish to retrieve, or it may be a string key name for an associative array or property name. It may also be null to return complete arrays or objects (this is useful together with index_key to reindex the array).
     * @param int|string|null $index_key The column to use as the index/keys for the returned array. This value may be the integer key of the column, or it may be the string key name. The value is cast as usual for array keys (however, prior to PHP 8.0.0, objects supporting conversion to string were also allowed).
     *
     * @return array Returns an array of values representing a single column from the input array.
     */
    function array_column($array, $column_key, $index_key = null) {
        return array_map(function ($element) use ($column_key) {
            return $element[$column_key];
        }, $array);
    }
}

/**
 * Polyfill: is_countable
 */
if (!function_exists('is_countable')) {
    /**
     * Verify that the contents of a variable is a countable value
     *
     * Verify that the contents of a variable is an array or an object implementing Countable
     *
     * @param array $value The value to check
     *
     * @return bool Returns true if value is countable, false otherwise.
     */
    function is_countable($value) {
        return is_array($value) || (is_object($value) && $value instanceof Countable);
    }
}

/**
 * Polyfill: array_is_list
 */
if (!function_exists('array_is_list')) {
    /**
     * Checks whether a given array is a list
     *
     * Determines if the given array is a list. An array is considered a list if its keys consist of consecutive numbers from 0 to count($array)-1.
     *
     * @param array $array The array being evaluated.
     *
     * @return bool Returns true if array is a list, false otherwise.
     */
    function array_is_list($array) {
        $i = 0;
        if (!is_array($array)) return false;

        foreach ($array as $k => $v)
            if ($k !== $i++)
                return false;

        return true;
    }
}

/**
 * Polyfill: array_key_first
 */
if (!function_exists('array_key_first')) {
    /**
     * Gets the first key of an array
     *
     * Get the first key of the given array without affecting the internal array pointer.
     *
     * @param array $array An array.
     *
     * @return string|int|null Returns the first key of array if the array is not empty; null otherwise.
     */
    function array_key_first($array) {
        foreach ($array as $key => $unused)
            return $key;
        return null;
    }
}

/**
 * Polyfill: array_key_last
 */
if (!function_exists('array_key_last')) {
    /**
     * Gets the last key of an array
     *
     * Get the last key of the given array without affecting the internal array pointer.
     *
     * @param array $array An array.
     *
     * @return int|string|null Returns the last key of array if the array is not empty; null otherwise.
     */
    function array_key_last($array) {
        if (is_array($array) && !empty($array)) return key(array_slice($array, -1, 1, true));
        return null;
    }
}

/**
 * Polyfill: str_contains
 */
if (!function_exists('str_contains')) {
    /**
     * Determine if a string contains a given substring
     *
     * @param string $haystack The string to search in.
     * @param string $needle The substring to search for in the $haystack.
     *
     * @return bool Returns true if $needle is in $haystack, false otherwise.
     */
    function str_contains($haystack, $needle) {
        return $needle !== '' && strpos($haystack, $needle) !== false;
    }
}

/**
 * Polyfill: str_starts_with
 */
if (!function_exists('str_starts_with')) {
    /**
     * Checks if a string starts with a given substring
     *
     * @param string $haystack The string to search in.
     * @param string $needle The substring to search for in the $haystack.
     *
     * @return bool Returns true if haystack begins with $needle, false otherwise.
     */
    function str_starts_with($haystack, $needle) {
        return strpos($haystack, $needle) === 0;
    }
}

/**
 * Polyfill: str_ends_with
 */
if (!function_exists('str_ends_with')) {
    /**
     * Checks if a string ends with a given substring
     *
     * @param string $haystack The string to search in.
     * @param string $needle The substring to search for in the $haystack.
     *
     * @return bool Returns true if haystack ends with $needle, false otherwise.
     */
    function str_ends_with($haystack, $needle) {
        $needle_len = strlen($needle);
        return ($needle_len === 0 || 0 === substr_compare($haystack, $needle, -$needle_len));
    }
}
