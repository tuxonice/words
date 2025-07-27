# Word Generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tuxonice/words.svg?style=flat-square)](https://packagist.org/packages/tuxonice/words)
[![Total Downloads](https://img.shields.io/packagist/dt/tuxonice/words.svg?style=flat-square)](https://packagist.org/packages/tuxonice/words)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tuxonice/words/php-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tuxonice/words/actions/workflows/php-tests.yml)
[![License](https://img.shields.io/github/license/tuxonice/words?style=flat-square)](https://github.com/tuxonice/words/blob/main/LICENSE.md)
[![PHP Version](https://img.shields.io/packagist/php-v/tuxonice/words?style=flat-square)](https://packagist.org/packages/tuxonice/words)

A PHP package for generating pronounceable words based on language-specific phonetic patterns. Perfect for creating fictional names, placeholder text, or language generation experiments.

## Features

- Generate random words based on language-specific letter transition probabilities
- Support for multiple languages (currently Portuguese and Spanish)
- Standard mode with authentic language-specific phonetic patterns
- Easy mode with simpler letter combinations for easier pronunciation
- Command-line interface for quick word generation
- Configurable maximum word length and quantity
- Option to save generated words to a file
- Extensible design for adding new languages
- Fully object-oriented implementation with PSR-4 autoloading

## Installation

### Via Composer

```bash
composer require tuxonice/words
```

### Manual Installation

```bash
# Clone the repository
git clone https://github.com/tuxonice/words.git
cd words

# Install dependencies
composer install
```

## Usage

### Word Length Behavior

The `generateWord()` and `generateWords()` methods accept a length parameter that specifies the **maximum** length of the generated words. The actual length of generated words may be shorter depending on the language's phonetic patterns and transition rules. This approach ensures more natural-sounding words while still keeping them within the desired length constraints.

### Basic Usage

```php
<?php

require_once 'vendor/autoload.php';

use Tlab\WordGenerator\WordGeneratorFacade;

// Create a generator with standard Portuguese patterns (default language)
$generator = WordGeneratorFacade::standard();

// Generate a single word
$word = $generator->generateWord(6); // 6 is the maximum word length
echo $word . PHP_EOL;

// Generate multiple words
$words = $generator->generateWords(5, 8); // 5 words with maximum length of 8
foreach ($words as $word) {
    echo $word . PHP_EOL;
}

// Use easy mode for simpler words
$easyGenerator = WordGeneratorFacade::easyMode();
$easyWords = $easyGenerator->generateWords(3, 5); // 3 words with maximum length of 5

// Easy mode for Spanish
$easySpanishGenerator = WordGeneratorFacade::easyMode('spanish');
$easySpanishWords = $easySpanishGenerator->generateWords(3, 5); // 3 words with maximum length of 5

// Generate Spanish words
$spanishGenerator = WordGeneratorFacade::standard('spanish');
$spanishWord = $spanishGenerator->generateWord(7);
echo "Spanish word: $spanishWord" . PHP_EOL;

// Use language codes
$ptGenerator = new WordGeneratorFacade('pt'); // Portuguese
$esGenerator = new WordGeneratorFacade('es'); // Spanish
```

## Package Structure

```
words/
├── src/                    # Source code
│   ├── Generator/          # Word generation logic
│   │   └── WordGenerator.php
│   ├── Matrix/             # Transition matrices
│   │   ├── LanguageMatrix.php     # Abstract base class for language matrices
│   │   ├── PortugueseMatrix.php   # Portuguese language matrix
│   │   ├── SpanishMatrix.php      # Spanish language matrix
│   │   └── TransitionMatrix.php   # Base matrix functionality
│   └── WordGeneratorFacade.php    # Main facade class
├── tests/                  # Unit tests
│   ├── Generator/
│   │   └── WordGeneratorTest.php
│   └── WordGeneratorFacadeTest.php
├── examples/               # Example usage scripts
│   ├── basic-usage.php
│   └── multi-language-usage.php
├── composer.json           # Composer configuration
└── README.md              # Documentation
```

## Sample Output

```
carito
beluna
devira
solami
poriza
lunare
matilo
serona
zubilo
tevara
façãos
preção
```

## Extending with New Languages

The package is designed to be easily extended with new languages. To add support for a new language:

1. Create a new class in the `src/Matrix` directory that extends `LanguageMatrix`
2. Implement the required methods:
   - `getLanguageCode()`: Return the language code (e.g., 'en', 'fr')
   - `getLanguageName()`: Return the full language name (e.g., 'English', 'French')
   - `createStandard()`: Create a standard transition matrix for the language
   - `createEasyMode()`: Create a simplified transition matrix for the language

Example:

```php
<?php

namespace Tlab\WordGenerator\Matrix;

class FrenchMatrix extends LanguageMatrix
{
    public function getLanguageCode(): string
    {
        return 'fr';
    }
    
    public function getLanguageName(): string
    {
        return 'French';
    }
    
    public static function createStandard(): self
    {
        // Define French-specific transition matrix
        $matrix = [
            // French vowels and consonants with their transitions
            // ...
        ];
        
        // Common French word endings
        $commonEndings = ['e', 'es', 'ent', 'ais', 'ait', 'er', 'ez', 'eur', 'euse', 'ion', 'tion'];
        
        return new self($matrix, $commonEndings);
    }
    
    public static function createEasyMode(): self
    {
        // Define simplified French transition matrix
        // ...
        
        return new self($easyMatrix, $easyEndings);
    }
}
```

3. Update the `createMatrixForLanguage()` method in `WordGeneratorFacade` to include your new language:

```php
protected function createMatrixForLanguage(string $language, bool $easyMode): LanguageMatrix
{
    switch ($language) {
        case 'portuguese':
        case 'pt':
            return $easyMode ? PortugueseMatrix::createEasyMode() : PortugueseMatrix::createStandard();
        case 'spanish':
        case 'es':
            return $easyMode ? SpanishMatrix::createEasyMode() : SpanishMatrix::createStandard();
        case 'french':
        case 'fr':
            return $easyMode ? FrenchMatrix::createEasyMode() : FrenchMatrix::createStandard();
        default:
            // Default to Portuguese if the language is not supported
            return $easyMode ? PortugueseMatrix::createEasyMode() : PortugueseMatrix::createStandard();
    }
}
```

## Running Tests

### Using Composer

```bash
composer test
```

### Using Docker

A Docker environment is provided for easy testing without installing PHP locally.

```bash
# Build and run tests
docker-compose up --build

# Run tests in an existing container
docker-compose run app composer test

# Run a shell in the container
docker-compose run app bash
```

## License

MIT
