<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Napryc\PHP8Compat\PHP8Compat;

// String padding examples
echo "String Padding Examples:\n";
echo PHP8Compat::mb_str_pad("Hello", 10, "-") . "\n";  // Hello-----
echo PHP8Compat::mb_str_pad("Hello", 10, "*", STR_PAD_LEFT) . "\n";  // *****Hello
echo PHP8Compat::mb_str_pad("Hello", 10, "*", STR_PAD_BOTH) . "\n";  // **Hello***

// String search examples
echo "\nString Search Examples:\n";
$text = "Hello World, welcome to PHP";
echo "Contains 'World': " . (PHP8Compat::str_contains($text, "World") ? 'true' : 'false') . "\n";
echo "Starts with 'Hello': " . (PHP8Compat::strStartsWith($text, "Hello") ? 'true' : 'false') . "\n";
echo "Ends with 'PHP': " . (PHP8Compat::strEndsWith($text, "PHP") ? 'true' : 'false') . "\n";
