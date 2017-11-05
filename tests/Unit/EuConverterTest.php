<?php

namespace WDConverter\Tests;

use PHPUnit\Framework\TestCase;
use WDConverter\Services\EuConverter;

class EuConverterTest extends TestCase
{
    /**
     * @test
     * @dataProvider provide_eu_conversions
     * @param int    $number
     * @param string $expected
     * @return void
     */
    public function eu_conversions($number, $expected)
    {
        // Test EU
        $converter = new EuConverter();
        $this->assertEquals($expected, $converter->int2str($number));
    }

    /**
     * Data provider for tests involving EU conversions
     * @return array
     */
    public function provide_eu_conversions()
    {
        // Array of input parameters and expected results
        return [
            [0, 'zero'],
            [100, 'one hundred'],
            [1000, 'one thousand'],
            [1000000, 'one million'],
            [2000000, 'two million'],
            [1000000000, 'one milliard'],
            [981432875, 'nine hundred eighty-one million four hundred thirty-two thousand eight hundred seventy-five'],
            [78902465231, 'seventy-eight milliard nine hundred two million four hundred sixty-five thousand two hundred thirty-one'],
            [-48526, 'negative forty-eight thousand five hundred twenty-six']
        ];
    }
}
