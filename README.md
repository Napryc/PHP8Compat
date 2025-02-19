# PHP8 Compatibility Layer

A lightweight compatibility layer that brings PHP 8.0+ string and array functions to PHP 7.1+ applications.

## Features

- Multi-byte string functions support
- Array manipulation utilities
- Zero dependencies (except ext-mbstring)
- PHP 7.1+ compatible
- Automatic fallback to native PHP 8 functions when available

## Installation

Install via Composer:

```bash
composer require napryc/php8-compat
```


## Available Functions

### String Functions

- `str_contains()` - Determine if a string contains a given substring
- `str_starts_with()` - Check if a string starts with a given substring
- `str_ends_with()` - Check if a string ends with a given substring
- `str_increment()` - Increment a string
- `str_decrement()` - Decrement a string
- `mb_str_pad()` - Pad a string to a certain length with another string
- `mb_trim()` - Strip whitespace or other characters from both sides
- `mb_ltrim()` - Strip whitespace or other characters from the left side
- `mb_rtrim()` - Strip whitespace or other characters from the right side
- `mb_ucfirst()` - Make a string's first character uppercase
- `mb_lcfirst()` - Make a string's first character lowercase
### Array Functions
- `array_is_list()` - Determine if an array is a list
- `array_find()` - Find first element matching callback
- `array_find_key()` - Find first key matching callback
- `array_any()` - Check if any element matches callback
- `array_all()` - Check if all elements match callback

### Math Functions
- `fdiv()` - Divide two numbers with proper handling of division by zero

### JSON Functions
- `json_validate()` - Validate a JSON string
## Usage


```php
use Napryc\PHP8Compat\PHP8Compat;

// String manipulation
$padded = PHP8Compat::mb_str_pad("Hello", 10, "-"); // "Hello-----"
$contains = PHP8Compat::str_contains("Hello World", "World"); // true
$starts = PHP8Compat::str_starts_with("Hello World", "Hello"); // true
$ends = PHP8Compat::str_ends_with("Hello World", "World"); // true

// String increment/decrement
$next = PHP8Compat::str_increment("a"); // "b"
$prev = PHP8Compat::str_decrement("b"); // "a"

// Multi-byte string functions
$trimmed = PHP8Compat::mb_trim("  Hello  "); // "Hello"

// Array checking
$isList = PHP8Compat::array_is_list([1, 2, 3]); // true

// Array searching
$found = PHP8Compat::array_find([1, 2, 3], fn($x) => $x > 1); // 2
$foundKey = PHP8Compat::array_find_key([1, 2, 3], fn($x) => $x > 1); // 1
$hasAny = PHP8Compat::array_any([1, 2, 3], fn($x) => $x > 2); // true
$allMatch = PHP8Compat::array_all([1, 2, 3], fn($x) => $x > 0); // true

// Safe division
$result = PHP8Compat::fdiv(10, 0); // INF
```


## Requirements

- PHP 7.1 or higher
- ext-mbstring extension

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
