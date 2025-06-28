<?php

namespace Tlab\WordGenerator\Tests\Generator;

use PHPUnit\Framework\TestCase;
use Tlab\WordGenerator\Generator\WordGenerator;
use Tlab\WordGenerator\Matrix\PortugueseMatrix;

class WordGeneratorTest extends TestCase
{
    /**
     * Test that a word can be generated with the standard matrix
     */
    public function testGenerateWordWithStandardMatrix()
    {
        $matrix = PortugueseMatrix::createStandard();
        $generator = new WordGenerator($matrix);
        
        $word = $generator->generateWord(6);
        
        $this->assertIsString($word);
        $this->assertEquals(6, strlen($word));
    }
    
    /**
     * Test that a word can be generated with the easy mode matrix
     */
    public function testGenerateWordWithEasyMatrix()
    {
        $matrix = PortugueseMatrix::createEasyMode();
        $generator = new WordGenerator($matrix);
        
        $word = $generator->generateWord(8);
        
        $this->assertIsString($word);
        $this->assertEquals(8, strlen($word));
    }
    
    /**
     * Test that multiple words can be generated
     */
    public function testGenerateMultipleWords()
    {
        $matrix = PortugueseMatrix::createStandard();
        $generator = new WordGenerator($matrix);
        
        $words = $generator->generateWords(5, 7);
        
        $this->assertIsArray($words);
        $this->assertCount(5, $words);
        foreach ($words as $word) {
            $this->assertIsString($word);
            $this->assertEquals(7, strlen($word));
        }
    }
}
