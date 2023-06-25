<?php

/**
 * Inane
 *
 * Polyfill: php 7.4.x
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
 * Polyfill: password_algos
 * 
 * @since 7.4.0
 */
if (!function_exists('password_algos')) {
	/**
	 * Get available password hashing algorithm IDs
	 *
	 * Returns a complete list of all registered password hashing algorithm IDs as an array of strings.
	 * 
	 * @link http://www.php.net/manual/en/function.password-algos.php
	 *
	 * @return array Returns the available password hashing algorithm IDs.
	 */
	function password_algos(): array {
		$algos = [PASSWORD_BCRYPT];
		defined('PASSWORD_ARGON2I')  && $algos[] = PASSWORD_ARGON2I;
		defined('PASSWORD_ARGON2ID') && $algos[] = PASSWORD_ARGON2ID;
		return $algos;
	}
}
