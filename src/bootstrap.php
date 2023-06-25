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
if (phpversion() < '5.5.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php55x.php');

/*********
 *  7.x
 ********/
if (phpversion() < '7.3.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php73x.php');
if (phpversion() < '7.4.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php74x.php');

/*********
 *  8.x
 ********/
if (phpversion() < '8.0.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php80x.php');
if (phpversion() < '8.1.0') require_once(__DIR__ . \DIRECTORY_SEPARATOR . 'compat/php81x.php');
