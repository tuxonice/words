<?php

namespace Tlab\WordGenerator\Tests;

use PHPUnit\Framework\TestCase;
use Tlab\WordGenerator\WordGeneratorFacade;

class WordGeneratorFacadeTest extends TestCase
{
    /**
     * Test the standard mode generator with default language (Portuguese)
     */
    public function testStandardGenerator()
    {
        $generator = WordGeneratorFacade::standard();
        
        $maxLength = 6;
        $word = $generator->generateWord($maxLength);
        
        $this->assertIsString($word);
        $this->assertLessThanOrEqual($maxLength, strlen($word));
        $this->assertGreaterThan(0, strlen($word), 'Word should not be empty');
    }
    
    /**
     * Test the easy mode generator with default language (Portuguese)
     */
    public function testEasyModeGenerator()
    {
        $generator = WordGeneratorFacade::easyMode();
        
        $maxLength = 6;
        $word = $generator->generateWord($maxLength);
        
        $this->assertIsString($word);
        $this->assertLessThanOrEqual($maxLength, strlen($word));
        $this->assertGreaterThan(0, strlen($word), 'Word should not be empty');
    }
    
    /**
     * Test generating multiple words
     */
    public function testGenerateMultipleWords()
    {
        $generator = new WordGeneratorFacade();
        
        $maxLength = 7;
        $words = $generator->generateWords(5, $maxLength);
        
        $this->assertIsArray($words);
        $this->assertCount(5, $words);
        foreach ($words as $word) {
            $this->assertIsString($word);
            $this->assertLessThanOrEqual($maxLength, strlen($word));
            $this->assertGreaterThan(0, strlen($word), 'Word should not be empty');
        }
    }
    
    /**
     * Test saving words to a file
     */
    public function testSaveToFile()
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
    public function testSpanishLanguage()
    {
        $generator = WordGeneratorFacade::standard('spanish');
        
        $maxLength = 6;
        $word = $generator->generateWord($maxLength);
        
        $this->assertIsString($word);
        $this->assertLessThanOrEqual($maxLength, strlen($word));
        $this->assertGreaterThan(0, strlen($word), 'Word should not be empty');
    }
    
    /**
     * Test language code usage
     */
    public function testLanguageCodeUsage()
    {
        $ptGenerator = new WordGeneratorFacade('pt');
        $esGenerator = new WordGeneratorFacade('es');
        
        $maxLength = 6;
        $ptWord = $ptGenerator->generateWord($maxLength);
        $esWord = $esGenerator->generateWord($maxLength);
        
        $this->assertIsString($ptWord);
        $this->assertIsString($esWord);
        $this->assertLessThanOrEqual($maxLength, strlen($ptWord));
        $this->assertLessThanOrEqual($maxLength, strlen($esWord));
        $this->assertGreaterThan(0, strlen($ptWord), 'Portuguese word should not be empty');
        $this->assertGreaterThan(0, strlen($esWord), 'Spanish word should not be empty');
    }
}
