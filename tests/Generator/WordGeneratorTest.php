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
    public function testGenerateWordWithStandardMatrix(): void
    {
        $matrix = PortugueseMatrix::createStandard();
        $generator = new WordGenerator($matrix);

        $word = $generator->generateWord(6);

        $this->assertLessThanOrEqual(6, mb_strlen($word));
    }

    /**
     * Test that a word can be generated with the easy mode matrix
     */
    public function testGenerateWordWithEasyMatrix(): void
    {
        $matrix = PortugueseMatrix::createEasyMode();
        $generator = new WordGenerator($matrix);

        $word = $generator->generateWord(8);

        $this->assertLessThanOrEqual(8, mb_strlen($word));
    }

    /**
     * Test that multiple words can be generated
     */
    public function testGenerateMultipleWords(): void
    {
        $matrix = PortugueseMatrix::createStandard();
        $generator = new WordGenerator($matrix);

        $maxLength = 7;
        $words = $generator->generateWords(5, $maxLength);

        $this->assertCount(5, $words);
        foreach ($words as $word) {
            $this->assertIsString($word);
            $this->assertLessThanOrEqual($maxLength, mb_strlen($word));
            $this->assertGreaterThan(0, mb_strlen($word), 'Word should not be empty');
        }
    }
}
