<?php

/**
 * Inane
 *
 * Polyfill: php 5.5.x
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
 * Polyfill: array_column
 * 
 * @since 5.5.0
 */
if (!function_exists('array_column')) {
	/**
	 * Return the values from a single column in the input array
	 *
	 * array_column() returns the values from a single column of the array, identified by the column_key. Optionally, an index_key may be provided to index the values in the returned array by the values from the index_key column of the input array.
	 * 
	 * @link http://www.php.net/manual/en/function.array-column.php
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
