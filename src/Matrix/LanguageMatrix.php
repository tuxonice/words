<?php

namespace Tlab\WordGenerator\Matrix;

/**
 * Abstract class LanguageMatrix
 *
 * Base class for all language-specific transition matrices
 */
abstract class LanguageMatrix extends TransitionMatrix
{
    /**
     * Get the language code for this matrix
     *
     * @return string The language code (e.g., 'en', 'pt', 'es')
     */
    abstract public function getLanguageCode(): string;

    /**
     * Get the language name
     *
     * @return string The full language name (e.g., 'English', 'Portuguese', 'Spanish')
     */
    abstract public function getLanguageName(): string;

    /**
     * Create a standard version of this language matrix
     *
     * @return self
     */
    abstract public static function createStandard(): self;

    /**
     * Create an easy mode version of this language matrix with simpler patterns
     *
     * @return self
     */
    abstract public static function createEasyMode(): self;
}
