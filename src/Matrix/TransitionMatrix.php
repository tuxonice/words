<?php

namespace Tlab\WordGenerator\Matrix;

/**
 * Class TransitionMatrix
 * 
 * Represents a transition matrix for letter probabilities in word generation
 */
class TransitionMatrix
{
    /**
     * @var array The transition matrix data
     */
    protected array $matrix;

    /**
     * @var array Common word endings
     */
    protected array $commonEndings;

    /**
     * TransitionMatrix constructor
     * 
     * @param array $matrix        The transition matrix data
     * @param array $commonEndings Common word endings
     */
    public function __construct(array $matrix, array $commonEndings)
    {
        $this->matrix = $matrix;
        $this->commonEndings = $commonEndings;
    }

    /**
     * Get the transition matrix data
     * 
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->matrix;
    }

    /**
     * Get the common word endings
     * 
     * @return array
     */
    public function getCommonEndings(): array
    {
        return $this->commonEndings;
    }

    /**
     * Get all possible starting letters (excluding those that never start Portuguese words)
     * 
     * @return array
     */
    public function getStartingLetters(): array
    {
        // Filter out 'ç' from possible starting letters as it's never used at the beginning of Portuguese words
        return array_filter(
            array_keys($this->matrix), function ($key) {
                return $key !== 'ç';
            }
        );
    }

    /**
     * Get possible next letters for a given letter
     * 
     * @param  string $letter The current letter
     * @return array|null Array of possible next letters or null if none exist
     */
    public function getNextLetters(string $letter): ?array
    {
        return $this->matrix[$letter] ?? null;
    }
}
