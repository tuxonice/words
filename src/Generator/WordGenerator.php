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
     * @param int $length Target word length
     * @return string Generated word
     */
    public function generateWord(int $length = 6): string
    {
        // Get all possible starting letters
        $startKeys = $this->matrix->getStartingLetters();
        $word = '';

        // Choose a random starting letter
        $current = $startKeys[array_rand($startKeys)];
        $word .= $current;

        // Build the word letter by letter
        for ($i = 1; $i < $length - 2; $i++) {
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
                $nextLetters = $this->matrix->getNextLetters($current);
                if (empty($nextLetters)) {
                    break;
                }
                $next = $nextLetters[array_rand($nextLetters)];
                $word .= $next;
                $current = $next;
            }
        }

        // Ensure we don't exceed the target length
        return substr($word, 0, $length);
    }

    /**
     * Generate multiple words
     * 
     * @param int $count Number of words to generate
     * @param int $length Target word length
     * @return array Array of generated words
     */
    public function generateWords(int $count, int $length = 6): array
    {
        $words = [];
        for ($i = 0; $i < $count; $i++) {
            $words[] = $this->generateWord($length);
        }
        return $words;
    }
}
