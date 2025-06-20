<?php
/**
 * Fake Portuguese Word Generator
 * 
 * This script generates pronounceable Portuguese-like words using a transition matrix
 * that models letter frequencies and combinations found in Portuguese.
 * 
 * Usage: php run.php [number_of_words] [word_length] [output_file]
 */

// Parse command line arguments
$numWords = 10;    // Default number of words
$wordLength = 6;   // Default word length
$outputFile = null; // Default to stdout

// Process command line arguments if provided
if (isset($argv[1]) && is_numeric($argv[1]) && $argv[1] > 0) {
    $numWords = (int)$argv[1];
}

if (isset($argv[2]) && is_numeric($argv[2]) && $argv[2] > 0) {
    $wordLength = (int)$argv[2];
}

if (isset($argv[3])) {
    $outputFile = $argv[3];
}

// Transition matrix based on Portuguese phonetic patterns
// Each key represents a letter, and its value array contains letters that commonly follow it
$matrix = [
    // Vowels - Portuguese has 5 basic vowels: a, e, i, o, u
    'a' => ['b','c','d','l','m','n','p','r','s','t','v','z','i','o','u'], // 'a' is common in Portuguese
    'e' => ['b','c','d','l','m','n','p','r','s','t','v','z','i','a','o','u'], // 'e' often appears at word endings
    'i' => ['a','c','d','l','m','n','r','s','t','v','z','o'], // 'i' is less common at word beginnings
    'o' => ['b','c','d','l','m','n','p','r','s','t','v','z','a','u'], // 'o' is common in Portuguese
    'u' => ['a','c','d','l','m','n','r','s','t','z','i','o'], // 'u' often follows 'q' and 'g'
    
    // Consonants - Portuguese has specific consonant patterns
    'b' => ['a','e','i','o','r','l'], // 'b' often followed by vowels or 'r'/'l'
    'c' => ['a','e','h','i','o','r','u'], // 'c' + 'h' makes 'ch' sound, common in Portuguese
    'd' => ['a','e','i','o','r'], // 'd' often followed by vowels or 'r'
    'f' => ['a','e','i','l','o','r','u'], // 'f' often followed by vowels
    'g' => ['a','e','i','o','u','r'], // 'g' + 'u' makes specific sound before 'e'/'i'
    'h' => ['a','e','i','o','u'], // 'h' is silent in Portuguese but appears in digraphs
    'j' => ['a','e','i','o','u'], // 'j' has specific sound in Portuguese
    'l' => ['a','e','i','o','u','h'], // 'l' + 'h' makes 'lh' sound, common in Portuguese
    'm' => ['a','e','i','o','u'], // 'm' often followed by vowels
    'n' => ['a','e','i','o','u','h'], // 'n' + 'h' makes 'nh' sound, common in Portuguese
    'p' => ['a','e','i','o','r','l'], // 'p' often followed by vowels or 'r'/'l'
    'q' => ['u'], // 'q' is always followed by 'u' in Portuguese
    'r' => ['a','e','i','o','u'], // 'r' has specific sounds in Portuguese
    's' => ['a','e','i','o','u','t'], // 's' often followed by vowels
    't' => ['a','e','i','o','u','r'], // 't' often followed by vowels or 'r'
    'v' => ['a','e','i','o','u'], // 'v' often followed by vowels
    'x' => ['a','e','i','o','u'], // 'x' has various sounds in Portuguese
    'z' => ['a','e','i','o','u'], // 'z' often appears at word endings
];

// Common word endings in Portuguese
$commonEndings = ['a', 'o', 'e', 'ar', 'er', 'ir', 'or', 'al', 'el', 'il', 'ol', 'es', 'as', 'os', 'is', 'em', 'am'];

/**
 * Generates a Portuguese-like word using the transition matrix
 * 
 * @param array $matrix Transition matrix of letter probabilities
 * @param int $length Target word length
 * @param array $commonEndings Array of common word endings
 * @return string Generated word
 */
function generateWordFromMatrix($matrix, $length = 6, $commonEndings = []) {
    // Get all possible starting letters
    $keys = array_keys($matrix);
    $word = '';

    // Choose a random starting letter
    $current = $keys[array_rand($keys)];
    $word .= $current;

    // Build the word letter by letter
    for ($i = 1; $i < $length - 2; $i++) {
        if (!isset($matrix[$current]) || empty($matrix[$current])) {
            break;
        }

        $next = $matrix[$current][array_rand($matrix[$current])];
        $word .= $next;
        $current = $next;
    }

    // Add a common Portuguese ending if the word is long enough
    if ($length >= 3 && !empty($commonEndings) && mt_rand(0, 1) == 1) {
        $ending = $commonEndings[array_rand($commonEndings)];
        // Make sure we don't exceed the target length
        if (strlen($word) + strlen($ending) > $length) {
            $word = substr($word, 0, $length - strlen($ending));
        }
        $word .= $ending;
    } else {
        // Complete the word to the target length
        while (strlen($word) < $length) {
            if (!isset($matrix[$current]) || empty($matrix[$current])) {
                break;
            }
            $next = $matrix[$current][array_rand($matrix[$current])];
            $word .= $next;
            $current = $next;
        }
    }

    // Ensure we don't exceed the target length
    return substr($word, 0, $length);
}

// Store generated words
$generatedWords = [];

// Generate the requested number of words
for ($i = 0; $i < $numWords; $i++) {
    $generatedWords[] = generateWordFromMatrix($matrix, $wordLength, $commonEndings);
}

// Output the generated words
$output = implode(PHP_EOL, $generatedWords) . PHP_EOL;

// Write to file or stdout
if ($outputFile) {
    try {
        file_put_contents($outputFile, $output);
        echo "Successfully wrote $numWords words to $outputFile" . PHP_EOL;
    } catch (Exception $e) {
        echo "Error writing to file: {$e->getMessage()}" . PHP_EOL;
    }
} else {
    echo $output;
}
