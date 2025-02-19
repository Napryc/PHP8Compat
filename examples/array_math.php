<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Napryc\PHP8Compat\PHP8Compat;

// array_is_list examples
echo "array_is_list Examples:\n";
$arrays = [
    [1, 2, 3],
    ['a' => 1, 'b' => 2],
    [0 => 'a', 1 => 'b'],
    [1 => 'a', 0 => 'b'],
    []
];

foreach ($arrays as $array) {
    echo "Array " . json_encode($array) . " is list: ";
    echo (PHP8Compat::array_is_list($array) ? 'true' : 'false') . "\n";
}

// array_find examples
echo "\narray_find Examples:\n";
$numbers = [1, 2, 3, 4, 5];
$found = PHP8Compat::array_find($numbers, fn($x) => $x > 3);
echo "First number greater than 3: " . $found . "\n";

// array_find_key examples
echo "\narray_find_key Examples:\n";
$assoc = ['a' => 10, 'b' => 20, 'c' => 30];
$foundKey = PHP8Compat::array_find_key($assoc, fn($x) => $x > 15);
echo "First key with value greater than 15: " . $foundKey . "\n";

// array_any examples
echo "\narray_any Examples:\n";
$hasNegative = PHP8Compat::array_any($numbers, fn($x) => $x < 0);
echo "Has negative numbers: " . ($hasNegative ? 'true' : 'false') . "\n";

// array_all examples
echo "\narray_all Examples:\n";
$allPositive = PHP8Compat::array_all($numbers, fn($x) => $x > 0);
echo "All numbers are positive: " . ($allPositive ? 'true' : 'false') . "\n";

// Division examples
echo "\nDivision Examples:\n";
echo "10 / 2 = " . PHP8Compat::fdiv(10, 2) . "\n";
echo "10 / 0 = " . PHP8Compat::fdiv(10, 0) . "\n";
echo "0 / 0 = " . PHP8Compat::fdiv(0, 0) . "\n";
