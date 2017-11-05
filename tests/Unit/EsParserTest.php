<?php

namespace WDConverter\Tests;

use PHPUnit\Framework\TestCase;
use WDConverter\Services\EsParser;

class EsParserTest extends TestCase
{
    /**
     * @test
     * @dataProvider provide_es_parsings
     * @param int    $number
     * @param string $expected
     * @return void
     */
    public function es_parsings($number, $expected)
    {
        // Test EN
        $parser = new EsParser();
        $this->assertEquals($expected, $parser->intGroup($number));
    }

    /**
     * Data provider for tests involving EN parsings
     * @return array
     */
    public function provide_es_parsings()
    {
        // Array of input parameters and expected results
        return [
            ['000', 'cero'],
            ['010', 'diez'],
            ['420', 'veinticuatro'],
            ['001', 'cien'],
            ['189', 'novecientos ochenta y uno'],
            ['234', 'cuatrocientos treinta y dos'],
            ['578', 'ochocientos setenta y cinco'],
            ['209', 'novecientos dos'],
            ['019', 'novecientos diez']
        ];
    }
}
