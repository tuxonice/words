<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tlab\WordGenerator\WordGenerator;

// Create a standard generator
$generator = WordGenerator::standard();

// Generate a single word
echo "Single word: " . $generator->generateWord() . PHP_EOL;

// Generate multiple words
echo "\nMultiple words (standard mode):\n";
$words = $generator->generateWords(5, 7); // 5 words of length 7
foreach ($words as $word) {
    echo "- $word\n";
}

// Use easy mode
$easyGenerator = WordGenerator::easyMode();

echo "\nMultiple words (easy mode):\n";
$easyWords = $easyGenerator->generateWords(5, 7); // 5 words of length 7
foreach ($easyWords as $word) {
    echo "- $word\n";
}

// Save to file example (commented out)
/*
$moreWords = $generator->generateWords(100, 6);
if ($generator->saveToFile($moreWords, __DIR__ . '/output.txt')) {
    echo "\nSuccessfully saved 100 words to file.\n";
}
*/
