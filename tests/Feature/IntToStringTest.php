<?php

namespace WDConverter\Tests;

use PHPUnit\Framework\TestCase;
use WDConverter\Converter;

class IntToStringTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function a_string_throws_an_invalid_argument_exception()
    {
        $converter = new Converter();
        $converter->int2str('1000');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function a_non_integer_throws_an_invalid_argument_exception()
    {
        $converter = new Converter();
        $converter->int2str(1000.5);
    }

    /**
     * @test
     * @expectedException OutOfRangeException
     * @return void
     */
    public function large_integers_throw_an_out_of_range_exception()
    {
        $converter = new Converter();
        $converter->int2str(pow(10, 18));
    }

    /**
     * @test
     * @dataProvider provide_us_conversions
     * @param int    $number
     * @param string $expected
     * @return void
     */
    public function us_conversions($number, $expected)
    {
        // Test US (default)
        $converter = new Converter();
        $this->assertEquals($expected, $converter->int2str($number));
    }

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
        $converter = new Converter('es');
        $this->assertEquals($expected, $converter->int2str($number));
    }

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
        $converter = new Converter('eu');
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
