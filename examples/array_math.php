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

// Division examples
echo "\nDivision Examples:\n";
echo "10 / 2 = " . PHP8Compat::fdiv(10, 2) . "\n";
echo "10 / 0 = " . PHP8Compat::fdiv(10, 0) . "\n";
echo "0 / 0 = " . PHP8Compat::fdiv(0, 0) . "\n";
