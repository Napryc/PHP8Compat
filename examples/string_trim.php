<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Napryc\PHP8Compat\PHP8Compat;

// String trimming examples
$text = "  \t Hello World \n  ";
echo "Original string: '$text'\n";
echo "Trimmed: '" . PHP8Compat::mb_trim($text) . "'\n";
echo "Left trimmed: '" . PHP8Compat::mb_ltrim($text) . "'\n";
echo "Right trimmed: '" . PHP8Compat::mb_rtrim($text) . "'\n";

// Custom character trimming
$customText = "...Hello World...";
echo "\nCustom trim examples:\n";
echo "Original: '$customText'\n";
echo "Trimmed dots: '" . PHP8Compat::mb_trim($customText, '.') . "'\n";
