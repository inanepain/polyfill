<?php

/**
 * Inane
 *
 * Polyfill: php 8.0.x
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
 * Polyfill: str_contains
 * 
 * @since 8.0.0
 */
if (!function_exists('str_contains')) {
	/**
	 * Determine if a string contains a given substring
	 * 
	 * @link http://www.php.net/manual/en/function.str-contains.php
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
 * 
 * @since 8.0.0
 */
if (!function_exists('str_starts_with')) {
	/**
	 * Checks if a string starts with a given substring
	 * 
	 * @link http://www.php.net/manual/en/function.str-starts-with.php
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
 * 
 * @since 8.0.0
 */
if (!function_exists('str_ends_with')) {
	/**
	 * Checks if a string ends with a given substring
	 * 
	 * @link http://www.php.net/manual/en/function.str-ends-with.php
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

/**
 * Polyfill: Stringable
 * 
 * @since 8.0.0
 */
if (!class_exists('Stringable')) {
	/**
	 * Stringable
	 * 
	 * The Stringable interface denotes a class as having a __toString() method. Unlike most interfaces, Stringable is implicitly present on any class that has the magic __toString() method defined, although it can and should be declared explicitly.
	 * 
	 * Its primary value is to allow functions to type check against the union type string|Stringable to accept either a string primitive or an object that can be cast to a string.
	 * 
	 * @link http://www.php.net/manual/en/class.stringable.php 
	 */
	interface Stringable {
		/* Methods */
		public function __toString(): string;
	}
}

/**
 * Polyfill: PhpToken
 * 
 * @since 8.0.0
 */
if (!class_exists('PhpToken')) {
	/**
	 * PhpToken
	 * 
	 * This class provides an alternative to token_get_all(). While the function returns tokens either as a single-character string, or an array with a token ID, token text and line number, PhpToken::tokenize() normalizes all tokens into PhpToken objects, which makes code operating on tokens more memory efficient and readable.
	 * 
	 * @link http://www.php.net/manual/en/class.stringable.php 
	 */
	class PhpToken implements Stringable {
		/**
		 * One of the T_* constants, or an integer < 256 representing a single-char token.
		 * 
		 * @var int
		 */
		public int $iid;

		/**
		 * The textual content of the token.
		 * 
		 * @property string
		 */
		public string $text;

		/**
		 * The starting line number (1-based) of the token.
		 * 
		 * @var int
		 */
		public int $line;

		/**
		 * The starting position (0-based) in the tokenized string.
		 * 
		 * @var int
		 */
		public int $pos;

		/**
		 * Returns a new PhpToken object
		 * 
		 * @link   https://www.php.net/manual/en/phptoken.construct.php
		 * 
		 * @param   int     $id       One of the T_* constants (see List of Parser Tokens), or an ASCII codepoint representing a single-char token.
		 * @param   string  $text     The textual content of the token.
		 * @param   int     $line     The starting line number (1-based) of the token.
		 * @param   int     $pos      The starting position (0-based) in the tokenized string (the number of bytes).
		 * 
		 * @return  object            Returns a new PhpToken object
		 */
		final public function __construct(int $id, string $text, int $line = -1, int $pos = -1) {
			$this->id = $id;
			$this->text = $text;
			$this->line = $line;
			$this->pos = $pos;
		}

		/**
		 * Returns the name of the token.
		 * 
		 * PARAMETERS : This function has no parameters.
		 * 
		 * @link https://www.php.net/manual/en/phptoken.gettokenname.php
		 * 
		 * @return string   Returns the name of the token.
		 * 
		 * COMMENTS
		 * --------
		 * getTokenName() is mainly useful for debugging purposes. 
		 * For single-char tokens with IDs below 256, it returns the extended ASCII character corresponding to the ID. 
		 * For known tokens, it returns the same result as token_name(). For unknown tokens, it returns null.
		 * 
		 * It should be noted that tokens that are not known to PHP are commonly used, 
		 * for example when emulating lexer behavior from future PHP versions. 
		 * In this case custom token IDs are used, so they should be handled gracefully. 
		 * 
		 */
		public function getTokenName(): ?string {
			if ($this->id < 256)
				return chr($this->id);
			else if ('UNKNOWN' !== $name = token_name($this->id))
				return $name;
			else
				return null;
		}

		/**
		 * Tells whether the token is of given kind.
		 * 
		 * @link https://www.php.net/manual/en/phptoken.is.php
		 * 
		 * @param int|string|array $kind    Either a single value to match the token's id or textual content, or an array thereof. 
		 * 
		 * @return bool   A boolean value whether the token is of given kind. 
		 * 
		 * COMMENTS
		 * --------
		 * The is() method allows checking for certain tokens, while abstracting over whether it is a single-char token $token->is(';'), 
		 * a multi-char token $token->is(T_FUNCTION), or whether multiple tokens are allowed $token->is([T_CLASS, T_TRAIT, T_INTERFACE]).
		 * 
		 * While non-generic code can easily check the appropriate property, such as $token->text == ';' or $token->id == T_FUNCTION, 
		 * token stream implementations commonly need to be generic over different token kinds and need to support specification 
		 * of multiple token kinds.* 
		 * 
		 * Whether the token has the given ID, the given text, or has an ID/text part of the given array.
		 */
		public function is(int|string|array  $kind): bool {
			if (is_array($kind)) {
				foreach ($kind as $singleKind) {
					if (is_string($singleKind)) {
						if ($this->text === $singleKind)
							return true;
					} else if (is_int($singleKind)) {
						if ($this->id === $singleKind)
							return true;
					} else
						throw new TypeError("Kind array must have elements of type int or string");
				}
				return false;
			} else if (is_string($kind))
				return $this->text === $kind;
			else if (is_int($kind))
				return $this->id === $kind;
			else
				throw new TypeError("Kind must be of type int, string or array");
		}

		/** 
		 * Tells whether the token would be ignored by the PHP parser.
		 * 
		 * @link https://www.php.net/manual/en/phptoken.isignorable.php
		 * 
		 * PARAMETERS: This function has no parameters.
		 * 
		 * @return  bool  A boolean value whether the token would be ignored by the PHP parser (such as whitespace or comments). 
		 * 
		 * @comments
		 * Whether this token would be ignored by the PHP parser. 
		 * 
		 * As a special case, it is very common that whitespace and comments need to be skipped during token processing. 
		 * The isIgnorable() method determines whether a token is ignored by the PHP parser. 
		 */
		public function isIgnorable(): bool {
			return $this->is([
				T_WHITESPACE,
				T_COMMENT,
				T_DOC_COMMENT,
				T_OPEN_TAG,
			]);
		}

		/**
		 * Returns the textual content of the token.
		 * 
		 * PARAMETERS : This function has no parameters.
		 * 
		 * @link https://www.php.net/manual/en/phptoken.tostring.php
		 * 
		 * @return string   A textual content of the token. 
		 */
		public function __toString(): string {
			return $this->text;
		}

		/**
		 * Same as token_get_all(), but returning array of PhpToken.
		 * @return static[]
		 */

		/**
		 * Splits given source into PHP tokens, represented by PhpToken objects.
		 * 
		 * @link   https://www.php.net/manual/en/phptoken.tokenize.php
		 * 
		 * @access  public
		 * @static
		 * 
		 * @param   string  $code     The PHP source to parse.
		 * @param   int     $flags    [Default=0] Valid flags: TOKEN_PARSE - Recognises the ability to use reserved words in specific contexts.
		 * 
		 * @return  array   An array of PHP tokens represented by instances of PhpToken or its descendants. 
		 *                  This method returns static[] so that PhpToken can be seamlessly extended. 
		 */
		public static function tokenize(string $code, int $flags = 0): array {
			return token_get_all($code, $flags);
		}
	}
}
