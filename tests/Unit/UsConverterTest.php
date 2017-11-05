<?php

namespace WDConverter\Tests;

use PHPUnit\Framework\TestCase;
use WDConverter\Services\UsConverter;

class UsConverterTest extends TestCase
{
    /**
     * @test
     * @dataProvider provide_us_conversions
     * @param int    $number
     * @param string $expected
     * @return void
     */
    public function us_conversions($number, $expected)
    {
        // Test US
        $converter = new UsConverter();
        $this->assertEquals($expected, $converter->int2str($number));
    }

    /**
     * Data provider for tests involving US conversions
     * @return array
     */
    public function provide_us_conversions()
    {
        // Array of input parameters and expected results
        return [
            [0, 'zero'],
            [100, 'one hundred'],
            [1000, 'one thousand'],
            [1000000, 'one million'],
            [2000000, 'two million'],
            [1000000000, 'one billion'],
            [981432875, 'nine hundred eighty-one million four hundred thirty-two thousand eight hundred seventy-five'],
            [78902465231, 'seventy-eight billion nine hundred two million four hundred sixty-five thousand two hundred thirty-one'],
            [-48526, 'negative forty-eight thousand five hundred twenty-six']
        ];
    }
}
