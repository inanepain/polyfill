<?php

/**
 * Inane
 *
 * Polyfill
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

/*********
 *  5.x
 ********/
if (PHP_VERSION < '5.5.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php55x.php');

/*********
 *  7.x
 ********/
if (PHP_VERSION < '7.3.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php73x.php');
if (PHP_VERSION < '7.4.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php74x.php');

/*********
 *  8.x
 ********/
if (PHP_VERSION < '8.0.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php80x.php');
if (PHP_VERSION < '8.1.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php81x.php');
//if (PHP_VERSION < '8.2.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php82x.php');
if (PHP_VERSION < '8.3.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php83x.php');
if (PHP_VERSION < '8.4.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php84x.php');
//if (PHP_VERSION < '8.5.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php85x.php');
