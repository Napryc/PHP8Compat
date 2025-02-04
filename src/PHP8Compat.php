<?php

namespace Napryc\PHP8Compat;

class PHP8Compat
{
    public const IS_PHP8 = PHP_VERSION_ID >= 80000;
    private const DEFAULT_TRIM_CHARS = " \x09\x0A\x0C\x0D\x00\x0B" .
    "\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}" .
    "\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}" .
    "\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}";

    /**
     * Pads a string to a certain length with another string, considering multi-byte characters
     *
     * @param string $string The input string
     * @param int $length The length to pad to
     * @param string $pad_string The string to pad with
     * @param int $pad_type The padding type (STR_PAD_RIGHT, STR_PAD_LEFT, or STR_PAD_BOTH)
     * @return string The padded string
     */
    public static function mb_str_pad($string, $length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        if (self::IS_PHP8) {
            return mb_str_pad($string, $length, $pad_string, $pad_type);
        }
        $str_len = mb_strlen($string);
        $pad_str_len = mb_strlen($pad_string);

        if (!$length || !$pad_str_len || $length <= $str_len) {
            return $string;
        }

        $padded_string = null;
        if ($pad_type == STR_PAD_BOTH) {
            $padding_length = ($length - $str_len) / 2;
            $repeat = ceil($padding_length / $pad_str_len);
            $padded_string = mb_substr(str_repeat($pad_string, $repeat), 0, floor($padding_length))
                    . $string
                    . mb_substr(str_repeat($pad_string, $repeat), 0, ceil($padding_length));
        } else {
            $repeat = ceil($str_len - $pad_str_len + $length);
            if ($pad_type == STR_PAD_RIGHT) {
                $padded_string = $string . str_repeat($pad_string, $repeat);
                $padded_string = mb_substr($padded_string, 0, $length);
            } else if ($pad_type == STR_PAD_LEFT) {
                $padded_string = str_repeat($pad_string, $repeat);
                $padded_string = mb_substr($padded_string, 0,
                            $length - (($str_len - $pad_str_len) + $pad_str_len))
                        . $string;
            }
        }

        return $padded_string;
    }

    /**
     * Strips whitespace or other characters from both ends of a string
     *
     * @param string $string The string to trim
     * @param string $chars Optional characters to trim
     * @return string The trimmed string
     */
    public static function mb_trim(string $string, string $chars = self::DEFAULT_TRIM_CHARS): string
    {
        if (self::IS_PHP8) {
            return mb_trim($string, $chars);
        }

        return static::mb_ltrim(static::mb_ltrim($string, $chars), $chars);
    }

    /**
     * Strips whitespace or other characters from the beginning of a string
     *
     * @param string $string The string to trim
     * @param string $chars Optional characters to trim
     * @return string The left trimmed string
     */
    public static function mb_ltrim(string $string, string $chars = self::DEFAULT_TRIM_CHARS): string
    {
        if (self::IS_PHP8) {
            return mb_ltrim($string, $chars);
        }

        $chars = preg_quote($chars);
        return preg_replace("/^[$chars]+/u", '', $string);
    }

    /**
     * Strips whitespace or other characters from the end of a string
     *
     * @param string $string The string to trim
     * @param string $chars Optional characters to trim
     * @return string The right trimmed string
     */
    public static function mb_rtrim(string $string, string $chars = self::DEFAULT_TRIM_CHARS): string
    {
        if (self::IS_PHP8) {
            return mb_rtrim($string, $chars);
        }

       $chars = preg_quote($chars);
        return preg_replace("/[$chars]+$/u", '', $string);
    }

    /**
     * Makes a string's first character uppercase
     *
     * @param string $string The input string
     * @return string The resulting string with first character uppercase
     */
    public static function mb_ucfirst(string $string): string
    {
        if (self::IS_PHP8) {
            return mb_ucfirst($string);
        }

        $firstChar = mb_substr($string, 0, 1);
        $rest = mb_substr($string, 1);
        return mb_strtoupper($firstChar) . $rest;
    }

    /**
     * Makes a string's first character lowercase
     *
     * @param string $string The input string
     * @return string The resulting string with first character lowercase
     */
    public static function mb_lcfirst(string $string): string
    {
        if (self::IS_PHP8) {
            return mb_lcfirst($string);
        }

        $firstChar = mb_substr($string, 0, 1);
        $rest = mb_substr($string, 1);
        return mb_strtolower($firstChar) . $rest;
    }

    /**
     * Determines if an array is a list (sequential integer keys starting from 0)
     *
     * @param array $arr The array to check
     * @return bool Returns true if the array is a list, false otherwise
     */
    public static function array_is_list(array $arr): bool
    {
        if (self::IS_PHP8) {
            return array_is_list($arr);
        }

        if ($arr === []) {
            return true;
        }

        $i = 0;
        foreach ($arr as $key => $value) {
            if ($key !== $i++) {
                return false;
            }
        }

        return true;
    }

    /**
     * Increments a string (e.g., 'a' -> 'b', 'z' -> 'aa')
     *
     * @param string $str The string to increment
     * @return string The incremented string
     */
    public static function str_increment(string $str): string
    {
        if (self::IS_PHP8) {
            return str_increment($str);
        }

        // Handle empty string
        if ($str === '') {
            return 'a';
        }

        // Convert to array of characters
        $chars = str_split($str);
        $lastIndex = count($chars) - 1;

        // Increment last character
        while ($lastIndex >= 0) {
            if ($chars[$lastIndex] === 'z') {
                $chars[$lastIndex] = 'a';
                $lastIndex--;
                continue;
            }
            if ($chars[$lastIndex] === 'Z') {
                $chars[$lastIndex] = 'A';
                $lastIndex--;
                continue;
            }
            if ($chars[$lastIndex] === '9') {
                $chars[$lastIndex] = '0';
                $lastIndex--;
                continue;
            }
            $chars[$lastIndex] = chr(ord($chars[$lastIndex]) + 1);
            break;
        }

        // If we've wrapped around completely, prepend new character
        if ($lastIndex < 0) {
            if (ctype_digit($chars[0])) {
                array_unshift($chars, '1');
            } else if (ctype_upper($chars[0])) {
                array_unshift($chars, 'A');
            } else {
                array_unshift($chars, 'a');
            }
        }

        return implode('', $chars);
    }

    /**
     * Decrements a string (e.g., 'b' -> 'a', 'aa' -> 'z')
     *
     * @param string $str The string to decrement
     * @return string The decremented string
     */
    public static function str_decrement(string $str): string
    {
        if (self::IS_PHP8) {
            return str_decrement($str);
        }

        // Handle empty string or 'a'
        if ($str === '' || $str === 'a') {
            return '';
        }

        // Convert to array of characters
        $chars = str_split($str);
        $lastIndex = count($chars) - 1;

        // Decrement last character
        while ($lastIndex >= 0) {
            if ($chars[$lastIndex] === 'a') {
                $chars[$lastIndex] = 'z';
                $lastIndex--;
                continue;
            }
            if ($chars[$lastIndex] === 'A') {
                $chars[$lastIndex] = 'Z';
                $lastIndex--;
                continue;
            }
            if ($chars[$lastIndex] === '0') {
                $chars[$lastIndex] = '9';
                $lastIndex--;
                continue;
            }
            $chars[$lastIndex] = chr(ord($chars[$lastIndex]) - 1);
            break;
        }

        // Remove leading character if it would result in an invalid string
        if ($lastIndex < 0) {
            array_shift($chars);
        }

        return implode('', $chars);
    }

    /**
     * Determines if a string contains a given substring
     *
     * @param string $haystack The string to search in
     * @param string $needle The substring to search for
     * @return bool Returns true if needle is found in haystack, false otherwise
     */
    public static function str_contains(string $haystack, string $needle): bool
    {
        if (self::IS_PHP8) {
            return str_contains($haystack, $needle);
        }
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }

    /**
     * Checks if a string starts with a given substring
     *
     * @param string $haystack The string to search in
     * @param string $needle The substring to search for
     * @return bool Returns true if haystack starts with needle, false otherwise
     */
    public static function strStartsWith(string $haystack, string $needle): bool
    {
        if (self::IS_PHP8) {
            return str_starts_with($haystack, $needle);
        }
        return $needle !== '' && mb_strpos($haystack, $needle) === 0;
    }

    /**
     * Checks if a string ends with a given substring
     *
     * @param string $haystack The string to search in
     * @param string $needle The substring to search for
     * @return bool Returns true if haystack ends with needle, false otherwise
     */
    public static function strEndsWith(string $haystack, string $needle): bool
    {
        if (self::IS_PHP8) {
            return str_ends_with($haystack, $needle);
        }
        return $needle !== '' && mb_substr($haystack, -mb_strlen($needle)) === $needle;
    }

    /**
     * Divides two numbers and handles division by zero
     *
     * @param float $dividend The number being divided
     * @param float $divisor The number dividing by
     * @return float Returns the division result, INF, -INF, or NAN for special cases
     */
    public static function fdiv(float $dividend, float $divisor): float
    {
        if (self::IS_PHP8) {
            return fdiv($dividend, $divisor);
        }

        if ($divisor == 0.0) {
            if ($dividend == 0.0) {
                return NAN;
            }
            return ($dividend > 0.0) ? INF : -INF;
        }

        return $dividend / $divisor;
    }
}