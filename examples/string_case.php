<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Napryc\PHP8Compat\PHP8Compat;

// Case manipulation examples
$text = "hello WORLD";
echo "Original: $text\n";
echo "First char uppercase: " . PHP8Compat::mb_ucfirst($text) . "\n";
echo "First char lowercase: " . PHP8Compat::mb_lcfirst(ucfirst($text)) . "\n";

// Multi-byte examples
$mbText = "über";
echo "\nMulti-byte example:\n";
echo "Original: $mbText\n";
echo "First char uppercase: " . PHP8Compat::mb_ucfirst($mbText) . "\n";
