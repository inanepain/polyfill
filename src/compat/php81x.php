<?php

/**
 * Inane
 *
 * Polyfill: php 8.1.x
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
 * Polyfill: array_is_list
 * 
 * @since 8.1.0
 */
if (!function_exists('array_is_list')) {
	/**
	 * Checks whether a given array is a list
	 *
	 * Determines if the given array is a list. An array is considered a list if its keys consist of consecutive numbers from 0 to count($array)-1.
	 * 
	 * @link http://www.php.net/manual/en/function.array-is-list.php
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
