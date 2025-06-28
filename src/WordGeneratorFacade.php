<?php

namespace Tlab\WordGenerator;

use Tlab\WordGenerator\Generator\WordGenerator;
use Tlab\WordGenerator\Matrix\LanguageMatrix;
use Tlab\WordGenerator\Matrix\PortugueseMatrix;
use Tlab\WordGenerator\Matrix\SpanishMatrix;

/**
 * Class WordGeneratorFacade
 * 
 * Main facade class for generating language-specific words
 */
class WordGeneratorFacade
{
    /**
     * @var WordGenerator The word generator instance
     */
    protected WordGenerator $generator;

    /**
     * @var string The language being used
     */
    protected string $language;

    /**
     * @var bool Whether to use easy mode
     */
    protected bool $easyMode;

    /**
     * WordGeneratorFacade constructor
     * 
     * @param string $language The language to use (default: 'portuguese')
     * @param bool   $easyMode Whether to use easy mode with simpler patterns
     */
    public function __construct(string $language = 'portuguese', bool $easyMode = false)
    {
        $this->language = strtolower($language);
        $this->easyMode = $easyMode;
        
        // Create the appropriate matrix based on language
        $matrix = $this->createMatrixForLanguage($language, $easyMode);
        $this->generator = new WordGenerator($matrix);
    }
    
    /**
     * Create a matrix for the specified language
     * 
     * @param  string $language The language to create a matrix for
     * @param  bool   $easyMode Whether to use easy mode
     * @return LanguageMatrix The language-specific matrix
     */
    protected function createMatrixForLanguage(string $language, bool $easyMode): LanguageMatrix
    {
        switch ($language) {
        case 'portuguese':
        case 'pt':
            return $easyMode ? PortugueseMatrix::createEasyMode() : PortugueseMatrix::createStandard();
        case 'spanish':
        case 'es':
            return $easyMode ? SpanishMatrix::createEasyMode() : SpanishMatrix::createStandard();
        default:
            // Default to Portuguese if the language is not supported
            return $easyMode ? PortugueseMatrix::createEasyMode() : PortugueseMatrix::createStandard();
        }
    }

    /**
     * Generate a single word in the selected language
     * 
     * @param  int $maxLength Maximum word length
     * @return string Generated word in the selected language
     */
    public function generateWord(int $maxLength = 6): string
    {
        return $this->generator->generateWord($maxLength);
    }

    /**
     * Generate multiple words in the selected language
     * 
     * @param  int $count     Number of words to generate
     * @param  int $maxLength Maximum word length for each word
     * @return array Array of generated words
     */
    public function generateWords(int $count, int $maxLength = 6): array
    {
        return $this->generator->generateWords($count, $maxLength);
    }

    /**
     * Save generated words to a file
     * 
     * @param  array  $words    Array of words to save
     * @param  string $filePath Path to save the file
     * @return bool True if successful, false otherwise
     */
    public function saveToFile(array $words, string $filePath): bool
    {
        try {
            $content = implode(PHP_EOL, $words) . PHP_EOL;
            return (bool) file_put_contents($filePath, $content);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Create a new instance with standard patterns for the specified language
     * 
     * @param  string $language The language to use
     * @return self
     */
    public static function standard(string $language = 'portuguese'): self
    {
        return new self($language, false);
    }

    /**
     * Create a new instance with easy mode (simpler patterns) for the specified language
     * 
     * @param  string $language The language to use
     * @return self
     */
    public static function easyMode(string $language = 'portuguese'): self
    {
        return new self($language, true);
    }
}
