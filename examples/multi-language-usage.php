<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tlab\WordGenerator\WordGeneratorFacade;

// Example 1: Generate Portuguese words (default language)
echo "=== Portuguese Words ===\n";
$generator = WordGeneratorFacade::standard();

// Generate a single word
echo "Single word: " . $generator->generateWord() . PHP_EOL;

// Generate multiple words
echo "\nMultiple words (standard mode):\n";
$words = $generator->generateWords(3, 7); // 3 words of length 7
foreach ($words as $word) {
    echo "- $word\n";
}

// Example 2: Generate Spanish words
echo "\n=== Spanish Words ===\n";
$spanishGenerator = WordGeneratorFacade::standard('spanish');

// Generate a single Spanish word
echo "Single word: " . $spanishGenerator->generateWord() . PHP_EOL;

// Generate multiple Spanish words
echo "\nMultiple words (standard mode):\n";
$spanishWords = $spanishGenerator->generateWords(3, 7); // 3 words of length 7
foreach ($spanishWords as $word) {
    echo "- $word\n";
}

// Example 3: Easy mode for both languages
echo "\n=== Easy Mode Comparison ===\n";

// Portuguese easy mode
echo "Portuguese (easy mode):\n";
$easyPortuguese = WordGeneratorFacade::easyMode('portuguese');
$easyPortugueseWords = $easyPortuguese->generateWords(3, 6);
foreach ($easyPortugueseWords as $word) {
    echo "- $word\n";
}

// Spanish easy mode
echo "\nSpanish (easy mode):\n";
$easySpanish = WordGeneratorFacade::easyMode('spanish');
$easySpanishWords = $easySpanish->generateWords(3, 6);
foreach ($easySpanishWords as $word) {
    echo "- $word\n";
}

// Example 4: Using language codes instead of full names
echo "\n=== Using Language Codes ===\n";

$ptGenerator = new WordGeneratorFacade('pt');
echo "Portuguese (using 'pt' code): " . $ptGenerator->generateWord(8) . PHP_EOL;

$esGenerator = new WordGeneratorFacade('es');
echo "Spanish (using 'es' code): " . $esGenerator->generateWord(8) . PHP_EOL;
