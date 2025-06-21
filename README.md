# Fake Portuguese Word Generator

A PHP script that generates **pronounceable Portuguese-like words** using a custom transition matrix and linguistic patterns. Perfect for creating fictional names, placeholder text, or language generation experiments.

## 🧠 How It Works

- Uses a transition matrix based on Portuguese phonetic patterns
- Each letter has a probability distribution of possible following letters
- Incorporates common Portuguese word endings
- Generates words of customizable length
- Includes special Portuguese characters like 'ç' (cedilla), which is now explicitly included in the output

## 🚀 Installation

No installation required! Simply download the `run.php` file and run it with PHP:

```bash
# Make sure you have PHP installed
php -v

# Clone or download this repository
# Then navigate to the directory
cd /path/to/words
```

## 📋 Usage

```bash
# Basic usage (generates 10 words of length 6)
php run.php

# Generate 20 words
php run.php 20

# Generate 15 words of length 8
php run.php 15 8

# Generate 50 words of length 5 and save to file
php run.php 50 5 output.txt

# Generate 10 words with easy spelling patterns
php run.php 10 6 null easy
```

## 🧪 Sample Output

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

## 🔧 Customization

You can customize the script by modifying:

1. The transition matrix in `run.php` to adjust letter frequencies
2. The common word endings array to change word terminations
3. The word generation algorithm parameters
4. Use the "easy" mode parameter for simpler, more easily pronounceable words

### Easy Spelling Mode

The script includes an "easy spelling mode" that generates words with:
- Simpler consonant-vowel patterns
- No complex letter combinations
- More predictable pronunciation
- Easier to spell and read

This mode is ideal for:
- Learning materials
- Names that need to be easily remembered
- Words that need to be easily pronounced by non-Portuguese speakers

### Example Code

```php
// Generate a single Portuguese-like word
$matrix = [...]; // The transition matrix
$commonEndings = ['a', 'o', 'e', 'ar', 'er', 'ir']; 
$word = generateWordFromMatrix($matrix, 6, $commonEndings);
echo $word;

// Generate an easy-to-spell word
$easyMatrix = [...]; // The simplified matrix
$easyEndings = ['a', 'o', 'e']; 
$easyWord = generateWordFromMatrix($easyMatrix, 6, $easyEndings, true);
echo $easyWord;
```

## 📦 Requirements

* PHP 7.0+
* No external dependencies

## 📝 License

This script is available under the MIT License—use it freely in your own projects!
