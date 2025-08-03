<?php

namespace Tlab\WordGenerator\Matrix;

/**
 * Class PortugueseMatrix
 *
 * Provides transition matrices for Portuguese-like word generation
 */
class PortugueseMatrix extends LanguageMatrix
{
    /**
     * {@inheritdoc}
     */
    public function getLanguageCode(): string
    {
        return 'pt';
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguageName(): string
    {
        return 'Portuguese';
    }
    /**
     * Create a standard Portuguese transition matrix
     *
     * @return self
     */
    /**
     * {@inheritdoc}
     */
    public static function createStandard(): self
    {
        // Transition matrix based on Portuguese phonetic patterns
        $matrix = [
            // Vowels - Portuguese has 5 basic vowels: a, e, i, o, u
            'a' => ['b','c','d','l','m','n','p','r','s','t','v','z','i','o','u','ç'], // 'a' is common in Portuguese
            'e' => ['b','c','d','l','m','n','p','r','s','t','v','z','i','a','o','u','ç'], // 'e' often appears at word endings
            'i' => ['a','c','d','l','m','n','r','s','t','v','z','o','ç'], // 'i' is less common at word beginnings
            'o' => ['b','c','d','l','m','n','p','r','s','t','v','z','a','u','ç'], // 'o' is common in Portuguese
            'u' => ['a','c','d','l','m','n','r','s','t','z','i','o','ç'], // 'u' often follows 'q' and 'g'

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
            'ç' => ['a','e','i','o','u'], // 'ç' (cedilla) is followed by vowels in Portuguese
        ];

        // Common word endings in Portuguese
        $commonEndings = ['a', 'o', 'e', 'ar', 'er', 'ir', 'or', 'al', 'el', 'il', 'ol', 'es', 'as', 'os', 'is', 'em', 'am', 'ção', 'ções'];

        return new self($matrix, $commonEndings);
    }

    /**
     * Create an easy mode Portuguese transition matrix with simpler patterns
     *
     * @return self
     */
    /**
     * {@inheritdoc}
     */
    public static function createEasyMode(): self
    {
        // Matrix for easy spelling mode - simpler letter combinations
        $easyMatrix = [
            // Vowels with simpler transitions
            'a' => ['b','c','d','l','m','n','p','r','s','t','v'], // Removed 'z', 'i', 'o', 'u', 'ç'
            'e' => ['b','c','d','l','m','n','p','r','s','t','v'], // Removed complex transitions
            'i' => ['a','c','d','l','m','n','r','s','t','v'],     // Removed 'z', 'o', 'ç'
            'o' => ['b','c','d','l','m','n','p','r','s','t','v'], // Removed complex transitions
            'u' => ['a','c','d','l','m','n','r','s','t'],         // Removed 'z', 'i', 'o', 'ç'

            // Consonants with simpler patterns
            'b' => ['a','e','i','o'], // Removed 'r','l' combinations
            'c' => ['a','e','i','o'], // Removed 'h','r','u' combinations
            'd' => ['a','e','i','o'], // Removed 'r' combinations
            'f' => ['a','e','i','o'], // Removed 'l','r','u' combinations
            'g' => ['a','e','i','o'], // Removed 'u','r' combinations
            'h' => ['a','e','i','o'], // Kept simple vowel combinations
            'j' => ['a','e','i','o'], // Kept simple vowel combinations
            'l' => ['a','e','i','o'], // Removed 'h' combinations
            'm' => ['a','e','i','o'], // Kept simple vowel combinations
            'n' => ['a','e','i','o'], // Removed 'h' combinations
            'p' => ['a','e','i','o'], // Removed 'r','l' combinations
            'r' => ['a','e','i','o'], // Kept simple vowel combinations
            's' => ['a','e','i','o'], // Removed 't' combinations
            't' => ['a','e','i','o'], // Removed 'r' combinations
            'v' => ['a','e','i','o'], // Kept simple vowel combinations
        ];

        // Simpler word endings for easy mode
        $easyEndings = ['a', 'o', 'e', 'ar', 'er', 'or', 'al', 'el', 'as', 'os', 'em'];

        return new self($easyMatrix, $easyEndings);
    }
}
