<?php

/**
 * Inane
 *
 * Polyfill: php 8.1.x
 *
 * PHP version 5.5
 *
 * @version $Id$
 * $Date$
 * @license UNLICENSE doc
 * @license https://github.com/inanepain/polyfill/raw/develop/UNLICENSE UNLICENSE
 *
 * @author  Philip Michael Raab<peep@inane.co.za>
 *
 */

if (!function_exists('json_validate')) {
    function json_validate(string $json, int $depth = 512, int $flags = 0): bool {
        if (0 !== $flags && \defined('JSON_INVALID_UTF8_IGNORE') && \JSON_INVALID_UTF8_IGNORE !== $flags) {
            throw new \ValueError('json_validate(): Argument #3 ($flags) must be a valid flag (allowed flags: JSON_INVALID_UTF8_IGNORE)');
        }

        if ($depth <= 0) {
            throw new \ValueError('json_validate(): Argument #2 ($depth) must be greater than 0');
        }

        if ($depth > 0x7FFFFFFF) {
            throw new \ValueError(sprintf('json_validate(): Argument #2 ($depth) must be less than %d', 0x7FFFFFFF));
        }

        json_decode($json, true, $depth, $flags);

        return \JSON_ERROR_NONE === json_last_error();
    }
}

if (extension_loaded('mbstring')) {
    if (!function_exists('mb_str_pad')) {
        function mb_str_pad(string $string, int $length, string $pad_string = ' ', int $pad_type = \STR_PAD_RIGHT, ?string $encoding = null): string {
            if (!\in_array($pad_type, [
                \STR_PAD_RIGHT,
                \STR_PAD_LEFT,
                \STR_PAD_BOTH,
            ], true)) {
                throw new \ValueError('mb_str_pad(): Argument #4 ($pad_type) must be STR_PAD_LEFT, STR_PAD_RIGHT, or STR_PAD_BOTH');
            }

            if (null === $encoding) {
                $encoding = mb_internal_encoding();
            }

            try {
                $validEncoding = @mb_check_encoding('', $encoding);
            } catch (\ValueError $e) {
                throw new \ValueError(sprintf('mb_str_pad(): Argument #5 ($encoding) must be a valid encoding, "%s" given', $encoding));
            }

            // BC for PHP 7.3 and lower
            if (!$validEncoding) {
                throw new \ValueError(sprintf('mb_str_pad(): Argument #5 ($encoding) must be a valid encoding, "%s" given', $encoding));
            }

            if (mb_strlen($pad_string, $encoding) <= 0) {
                throw new \ValueError('mb_str_pad(): Argument #3 ($pad_string) must be a non-empty string');
            }

            $paddingRequired = $length - mb_strlen($string, $encoding);

            if ($paddingRequired < 1) {
                return $string;
            }

            switch ($pad_type) {
                case \STR_PAD_LEFT:
                    return mb_substr(str_repeat($pad_string, $paddingRequired), 0, $paddingRequired, $encoding) . $string;
                case \STR_PAD_RIGHT:
                    return $string . mb_substr(str_repeat($pad_string, $paddingRequired), 0, $paddingRequired, $encoding);
                default:
                    $leftPaddingLength = floor($paddingRequired / 2);
                    $rightPaddingLength = $paddingRequired - $leftPaddingLength;

                    return mb_substr(str_repeat($pad_string, $leftPaddingLength), 0, $leftPaddingLength, $encoding) . $string . mb_substr(str_repeat($pad_string,
                            $rightPaddingLength), 0, $rightPaddingLength, $encoding);
            }
        }
    }
}

if (!function_exists('stream_context_set_options')) {
    function stream_context_set_options($context, array $options): bool { return stream_context_set_option($context, $options); }
}

if (!function_exists('str_increment')) {
    function str_increment(string $string): string {
        if ('' === $string) {
            throw new \ValueError('str_increment(): Argument #1 ($string) cannot be empty');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $string)) {
            throw new \ValueError('str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters');
        }

        if (is_numeric($string)) {
            $offset = stripos($string, 'e');
            if (false !== $offset) {
                $char = $string[$offset];
                ++$char;
                $string[$offset] = $char;
                ++$string;

                switch ($string[$offset]) {
                    case 'f':
                        $string[$offset] = 'e';
                        break;
                    case 'F':
                        $string[$offset] = 'E';
                        break;
                    case 'g':
                        $string[$offset] = 'f';
                        break;
                    case 'G':
                        $string[$offset] = 'F';
                        break;
                }

                return $string;
            }
        }

        return ++$string;
    }
}

if (!function_exists('str_decrement')) {
    function str_decrement(string $string): string {
        if ('' === $string) {
            throw new \ValueError('str_decrement(): Argument #1 ($string) cannot be empty');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $string)) {
            throw new \ValueError('str_decrement(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters');
        }

        if (preg_match('/\A(?:0[aA0]?|[aA])\z/', $string)) {
            throw new \ValueError(sprintf('str_decrement(): Argument #1 ($string) "%s" is out of decrement range', $string));
        }

        if (!\in_array(substr($string, -1), [
            'A',
            'a',
            '0',
        ], true)) {
            return implode('', \array_slice(str_split($string), 0, -1)) . \chr(\ord(substr($string, -1)) - 1);
        }

        $carry = '';
        $decremented = '';

        for($i = \strlen($string) - 1; $i >= 0; --$i) {
            $char = $string[$i];

            switch ($char) {
                case 'A':
                    if ('' !== $carry) {
                        $decremented = $carry . $decremented;
                        $carry = '';
                    }
                    $carry = 'Z';

                    break;
                case 'a':
                    if ('' !== $carry) {
                        $decremented = $carry . $decremented;
                        $carry = '';
                    }
                    $carry = 'z';

                    break;
                case '0':
                    if ('' !== $carry) {
                        $decremented = $carry . $decremented;
                        $carry = '';
                    }
                    $carry = '9';

                    break;
                case '1':
                    if ('' !== $carry) {
                        $decremented = $carry . $decremented;
                        $carry = '';
                    }

                    break;
                default:
                    if ('' !== $carry) {
                        $decremented = $carry . $decremented;
                        $carry = '';
                    }

                    if (!\in_array($char, [
                        'A',
                        'a',
                        '0',
                    ], true)) {
                        $decremented = \chr(\ord($char) - 1) . $decremented;
                    }
            }
        }

        return $decremented;
    }
}

if (!function_exists('ldap_exop_sync') && function_exists('ldap_exop')) {
    function ldap_exop_sync($ldap, string $request_oid, ?string $request_data = null, ?array $controls = null, &$response_data = null, &$response_oid = null): bool {
        return ldap_exop($ldap, $request_oid, $request_data, $controls, $response_data, $response_oid);
    }
}

if (!function_exists('ldap_connect_wallet') && function_exists('ldap_connect')) {
    function ldap_connect_wallet(?string $uri, string $wallet, string $password, int $auth_mode = \GSLC_SSL_NO_AUTH) { return ldap_connect($uri, $wallet, $password, $auth_mode); }
}
