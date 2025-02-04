<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Napryc\PHP8Compat\PHP8Compat;

// String increment examples
echo "String Increment Examples:\n";
echo "a -> " . PHP8Compat::str_increment("a") . "\n";  // b
echo "z -> " . PHP8Compat::str_increment("z") . "\n";  // aa
echo "Az -> " . PHP8Compat::str_increment("Az") . "\n";  // Ba
echo "9 -> " . PHP8Compat::str_increment("9") . "\n";  // 10

// String decrement examples
echo "\nString Decrement Examples:\n";
echo "b -> " . PHP8Compat::str_decrement("b") . "\n";  // a
echo "aa -> " . PHP8Compat::str_decrement("aa") . "\n";  // z
echo "Ba -> " . PHP8Compat::str_decrement("Ba") . "\n";  // Az
echo "10 -> " . PHP8Compat::str_decrement("10") . "\n";  // 9
