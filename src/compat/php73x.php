<?php

/**
 * Inane
 *
 * Polyfill: php 7.3.x
 *
 * PHP version 5.5
 *
 * @author Philip Michael Raab<peep@inane.co.za>
 *
 * @license UNLICENSE doc
 * @license https://github.com/inanepain/polyfill/raw/develop/UNLICENSE UNLICENSE
 *
 * @version $Id$
 * $Date$
 */

/**
 * Polyfill: is_countable
 * 
 * @since 7.3.0
 */
if (!function_exists('is_countable')) {
	/**
	 * Verify that the contents of a variable is a countable value
	 *
	 * Verify that the contents of a variable is an array or an object implementing Countable
	 * 
	 * @link http://www.php.net/manual/en/function.is-countable.php
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
 * Polyfill: array_key_first
 * 
 * @since 7.3.0
 */
if (!function_exists('array_key_first')) {
	/**
	 * Gets the first key of an array
	 *
	 * Get the first key of the given array without affecting the internal array pointer.
	 * 
	 * @link http://www.php.net/manual/en/function.array-key-first.php
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
 * 
 * @since 7.3.0
 */
if (!function_exists('array_key_last')) {
	/**
	 * Gets the last key of an array
	 *
	 * Get the last key of the given array without affecting the internal array pointer.
	 * 
	 * @link http://www.php.net/manual/en/function.array-key-last.php
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
