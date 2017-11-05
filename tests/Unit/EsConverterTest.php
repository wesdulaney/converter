<?php

namespace WDConverter\Tests;

use PHPUnit\Framework\TestCase;
use WDConverter\Services\EsConverter;

class EsConverterTest extends TestCase
{
    /**
     * @test
     * @dataProvider provide_es_conversions
     * @param int    $number
     * @param string $expected
     * @return void
     */
    public function es_conversions($number, $expected)
    {
        // Test ES
        $converter = new EsConverter();
        $this->assertEquals($expected, $converter->int2str($number));
    }

    /**
     * Data provider for tests involving ES conversions
     * @return array
     */
    public function provide_es_conversions()
    {
        // Array of input parameters and expected results
        return [
            [0, 'cero'],
            [100, 'cien'],
            [1000, 'un mil'],
            [1000000, 'un millon'],
            [2000000, 'dos millones'],
            [1000000000, 'un mil millones'],
            [981432875, 'novecientos ochenta y un millones cuatrocientos treinta y dos mil ochocientos setenta y cinco'],
            [78902465231, 'setenta y ocho mil millones novecientos dos millones cuatrocientos sesenta y cinco mil doscientos treinta y uno'],
            [-48526, 'menos cuarenta y ocho mil quinientos veintiseis']
        ];
    }
}
