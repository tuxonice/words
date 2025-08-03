<?php

namespace Tlab\WordGenerator\Tests;

use PHPUnit\Framework\TestCase;
use Tlab\WordGenerator\WordGeneratorFacade;

class WordGeneratorFacadeTest extends TestCase
{
    /**
     * Test the standard mode generator with default language (Portuguese)
     */
    public function testStandardGenerator(): void
    {
        $generator = WordGeneratorFacade::standard();

        $maxLength = 6;
        $word = $generator->generateWord($maxLength);

        $this->assertLessThanOrEqual($maxLength, mb_strlen($word));
        $this->assertGreaterThan(0, mb_strlen($word), 'Word should not be empty');
    }

    /**
     * Test the easy mode generator with default language (Portuguese)
     */
    public function testEasyModeGenerator(): void
    {
        $generator = WordGeneratorFacade::easyMode();

        $maxLength = 6;
        $word = $generator->generateWord($maxLength);

        $this->assertLessThanOrEqual($maxLength, mb_strlen($word));
        $this->assertGreaterThan(0, mb_strlen($word), 'Word should not be empty');
    }

    /**
     * Test generating multiple words
     */
    public function testGenerateMultipleWords(): void
    {
        $generator = new WordGeneratorFacade();

        $maxLength = 7;
        $words = $generator->generateWords(5, $maxLength);

        $this->assertCount(5, $words);
        foreach ($words as $word) {
            $this->assertIsString($word);
            $this->assertLessThanOrEqual($maxLength, mb_strlen($word));
            $this->assertGreaterThan(0, mb_strlen($word), 'Word should not be empty');
        }
    }

    /**
     * Test saving words to a file
     */
    public function testSaveToFile(): void
    {
        $generator = new WordGeneratorFacade();
        $words = $generator->generateWords(5);
        $tempFile = sys_get_temp_dir() . '/generated_words_test.txt';

        $result = $generator->saveToFile($words, $tempFile);

        $this->assertTrue($result);
        $this->assertFileExists($tempFile);

        $content = file_get_contents($tempFile);
        $this->assertEquals(implode(PHP_EOL, $words) . PHP_EOL, $content);

        // Clean up
        @unlink($tempFile);
    }

    /**
     * Test Spanish language generator
     */
    public function testSpanishLanguage(): void
    {
        $generator = WordGeneratorFacade::standard('spanish');

        $maxLength = 6;
        $word = $generator->generateWord($maxLength);

        $this->assertLessThanOrEqual($maxLength, mb_strlen($word));
        $this->assertGreaterThan(0, mb_strlen($word), 'Word should not be empty');
    }

    /**
     * Test language code usage
     */
    public function testLanguageCodeUsage(): void
    {
        $ptGenerator = new WordGeneratorFacade('pt');
        $esGenerator = new WordGeneratorFacade('es');

        $maxLength = 6;
        $ptWord = $ptGenerator->generateWord($maxLength);
        $esWord = $esGenerator->generateWord($maxLength);

        $this->assertLessThanOrEqual($maxLength, mb_strlen($ptWord));
        $this->assertLessThanOrEqual($maxLength, mb_strlen($esWord));
        $this->assertGreaterThan(0, mb_strlen($ptWord), 'Portuguese word should not be empty');
        $this->assertGreaterThan(0, mb_strlen($esWord), 'Spanish word should not be empty');
    }
}
