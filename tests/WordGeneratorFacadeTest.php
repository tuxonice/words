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
        
        $word = $generator->generateWord(6);
        
        $this->assertIsString($word);
        $this->assertEquals(6, strlen($word));
    }
    
    /**
     * Test the easy mode generator with default language (Portuguese)
     */
    public function testEasyModeGenerator()
    {
        $generator = WordGeneratorFacade::easyMode();
        
        $word = $generator->generateWord(6);
        
        $this->assertIsString($word);
        $this->assertEquals(5, strlen($word));
    }
    
    /**
     * Test generating multiple words
     */
    public function testGenerateMultipleWords()
    {
        $generator = new WordGeneratorFacade();
        
        $words = $generator->generateWords(5, 7);
        
        $this->assertIsArray($words);
        $this->assertCount(5, $words);
        foreach ($words as $word) {
            $this->assertIsString($word);
            $this->assertEquals(6, strlen($word));
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
     * Test Spanish language generation
     */
    public function testSpanishLanguage()
    {
        $generator = WordGeneratorFacade::standard('spanish');
        
        $word = $generator->generateWord(6);
        
        $this->assertIsString($word);
        $this->assertEquals(6, strlen($word));
    }
    
    /**
     * Test language code usage
     */
    public function testLanguageCodeUsage()
    {
        $ptGenerator = new WordGeneratorFacade('pt');
        $esGenerator = new WordGeneratorFacade('es');
        
        $ptWord = $ptGenerator->generateWord(6);
        $esWord = $esGenerator->generateWord(6);
        
        $this->assertIsString($ptWord);
        $this->assertIsString($esWord);
        $this->assertEquals(6, strlen($ptWord));
        $this->assertEquals(6, strlen($esWord));
    }
}
