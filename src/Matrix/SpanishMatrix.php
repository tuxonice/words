<?php

namespace Tlab\WordGenerator\Matrix;

/**
 * Class SpanishMatrix
 *
 * Provides transition matrices for Spanish-like word generation
 */
class SpanishMatrix extends LanguageMatrix
{
    /**
     * {@inheritdoc}
     */
    public function getLanguageCode(): string
    {
        return 'es';
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguageName(): string
    {
        return 'Spanish';
    }

    /**
     * {@inheritdoc}
     */
    public static function createStandard(): self
    {
        // Transition matrix based on Spanish phonetic patterns
        $matrix = [
            // Vowels - Spanish has 5 basic vowels: a, e, i, o, u
            'a' => ['b','c','d','l','m','n','p','r','s','t','v','y','i','o','u'], // 'a' is common in Spanish
            'e' => ['b','c','d','l','m','n','p','r','s','t','v','x','z','i','a','o','u'], // 'e' often appears at word endings
            'i' => ['a','c','d','l','m','n','r','s','t','v','o'], // 'i' is less common at word beginnings
            'o' => ['b','c','d','l','m','n','p','r','s','t','v','a','u'], // 'o' is common in Spanish
            'u' => ['a','c','d','l','m','n','r','s','t','i','o'], // 'u' often follows 'q' and 'g'

            // Consonants - Spanish has specific consonant patterns
            'b' => ['a','e','i','o','r','l'], // 'b' often followed by vowels or 'r'/'l'
            'c' => ['a','e','h','i','o','r','u'], // 'c' + 'h' makes 'ch' sound, common in Spanish
            'd' => ['a','e','i','o','r'], // 'd' often followed by vowels or 'r'
            'f' => ['a','e','i','l','o','r','u'], // 'f' often followed by vowels
            'g' => ['a','e','i','o','u','r'], // 'g' + 'u' makes specific sound before 'e'/'i'
            'h' => ['a','e','i','o','u'], // 'h' is silent in Spanish
            'j' => ['a','e','i','o','u'], // 'j' has specific sound in Spanish
            'l' => ['a','e','i','o','u','l'], // 'll' is a specific sound in Spanish
            'm' => ['a','e','i','o','u'], // 'm' often followed by vowels
            'n' => ['a','e','i','o','u'], // 'ñ' is a separate letter in Spanish
            'p' => ['a','e','i','o','r','l'], // 'p' often followed by vowels or 'r'/'l'
            'q' => ['u'], // 'q' is always followed by 'u' in Spanish
            'r' => ['a','e','i','o','u','r'], // 'rr' is a specific sound in Spanish
            's' => ['a','e','i','o','u','t'], // 's' often followed by vowels
            't' => ['a','e','i','o','u','r'], // 't' often followed by vowels or 'r'
            'v' => ['a','e','i','o','u'], // 'v' often followed by vowels
            'x' => ['a','e','i','o','u'], // 'x' has various sounds in Spanish
            'y' => ['a','e','i','o','u'], // 'y' can be both a consonant and a vowel in Spanish
            'z' => ['a','e','i','o','u'], // 'z' has a specific sound in Spanish
            'ñ' => ['a','e','i','o','u'], // 'ñ' is a specific Spanish letter
        ];

        // Common word endings in Spanish
        $commonEndings = ['a', 'o', 'e', 'ar', 'er', 'ir', 'or', 'al', 'el', 'il', 'ol', 'es', 'as', 'os', 'is', 'ión', 'dad', 'tad', 'mente'];

        return new self($matrix, $commonEndings);
    }

    /**
     * {@inheritdoc}
     */
    public static function createEasyMode(): self
    {
        // Matrix for easy spelling mode - simpler letter combinations
        $easyMatrix = [
            // Vowels with simpler transitions
            'a' => ['b','c','d','l','m','n','p','r','s','t'],
            'e' => ['b','c','d','l','m','n','p','r','s','t'],
            'i' => ['a','c','d','l','m','n','r','s','t'],
            'o' => ['b','c','d','l','m','n','p','r','s','t'],
            'u' => ['a','c','d','l','m','n','r','s','t'],

            // Consonants with simpler patterns
            'b' => ['a','e','i','o'],
            'c' => ['a','e','i','o'],
            'd' => ['a','e','i','o'],
            'f' => ['a','e','i','o'],
            'g' => ['a','e','i','o'],
            'h' => ['a','e','i','o'],
            'j' => ['a','e','i','o'],
            'l' => ['a','e','i','o'],
            'm' => ['a','e','i','o'],
            'n' => ['a','e','i','o'],
            'p' => ['a','e','i','o'],
            'r' => ['a','e','i','o'],
            's' => ['a','e','i','o'],
            't' => ['a','e','i','o'],
            'v' => ['a','e','i','o'],
        ];

        // Simpler word endings for easy mode
        $easyEndings = ['a', 'o', 'e', 'ar', 'er', 'or', 'al', 'el', 'as', 'os'];

        return new self($easyMatrix, $easyEndings);
    }
}
