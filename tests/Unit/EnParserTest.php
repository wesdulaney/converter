<?php

namespace WDConverter\Tests;

use PHPUnit\Framework\TestCase;
use WDConverter\Services\EnParser;

class EnParserTest extends TestCase
{
    /**
     * @test
     * @dataProvider provide_en_parsings
     * @param int    $number
     * @param string $expected
     * @return void
     */
    public function en_parsings($number, $expected)
    {
        // Test EN
        $parser = new EnParser();
        $this->assertEquals($expected, $parser->intGroup($number));
    }

    /**
     * Data provider for tests involving EN parsings
     * @return array
     */
    public function provide_en_parsings()
    {
        // Array of input parameters and expected results
        return [
            ['000', 'zero'],
            ['010', 'ten'],
            ['001', 'one hundred'],
            ['189', 'nine hundred eighty-one'],
            ['234', 'four hundred thirty-two'],
            ['578', 'eight hundred seventy-five'],
            ['209', 'nine hundred two'],
            ['019', 'nine hundred ten']
        ];
    }
}
