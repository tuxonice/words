<?php

namespace Tlab\WordGenerator\Generator;

use Tlab\WordGenerator\Matrix\TransitionMatrix;

/**
 * Class WordGenerator
 * 
 * Generates pronounceable words based on a transition matrix
 */
class WordGenerator
{
    /**
     * @var TransitionMatrix The transition matrix to use for word generation
     */
    protected TransitionMatrix $matrix;

    /**
     * WordGenerator constructor
     * 
     * @param TransitionMatrix $matrix The transition matrix to use
     */
    public function __construct(TransitionMatrix $matrix)
    {
        $this->matrix = $matrix;
    }

    /**
     * Generate a single word
     * 
     * @param  int $maxLength Maximum word length
     * @return string Generated word
     */
    public function generateWord(int $maxLength = 6): string
    {
        // Get all possible starting letters
        $startKeys = $this->matrix->getStartingLetters();
        $word = '';

        // Choose a random starting letter
        $current = $startKeys[array_rand($startKeys)];
        $word .= $current;

        // Build the word letter by letter
        for ($i = 1; $i < $maxLength - 2; $i++) {
            $nextLetters = $this->matrix->getNextLetters($current);
            if (empty($nextLetters)) {
                break;
            }

            $next = $nextLetters[array_rand($nextLetters)];
            $word .= $next;
            $current = $next;
        }

        // Add a common ending if the word is long enough
        $commonEndings = $this->matrix->getCommonEndings();
        if ($maxLength >= 3 && !empty($commonEndings) && mt_rand(0, 1) == 1) {
            $ending = $commonEndings[array_rand($commonEndings)];
            // Make sure we don't exceed the maximum length
            if (strlen($word) + strlen($ending) > $maxLength) {
                $word = substr($word, 0, $maxLength - strlen($ending));
            }
            $word .= $ending;
        } else {
            // Complete the word up to the maximum length
            while (strlen($word) < $maxLength) {
                $nextLetters = $this->matrix->getNextLetters($current);
                if (empty($nextLetters)) {
                    break;
                }
                $next = $nextLetters[array_rand($nextLetters)];
                $word .= $next;
                $current = $next;
            }
        }

        // Ensure we don't exceed the maximum length
        return substr($word, 0, $maxLength);
    }

    /**
     * Generate multiple words
     * 
     * @param  int $count  Number of words to generate
     * @param  int $maxLength Maximum word length
     * @return array Array of generated words
     */
    public function generateWords(int $count, int $maxLength = 6): array
    {
        $words = [];
        for ($i = 0; $i < $count; $i++) {
            $words[] = $this->generateWord($maxLength);
        }
        return $words;
    }
}
