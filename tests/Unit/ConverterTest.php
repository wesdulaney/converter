<?php

namespace WDConverter\Tests;

use PHPUnit\Framework\TestCase;
use WDConverter\Converter;

class ConverterTest extends TestCase
{
    /**
     * @test
     */
    public function not_specifying_a_region_does_not_throw_an_invalid_argument_exception()
    {
        $this->assertInstanceOf(Converter::class, new Converter());
    }

    /**
     * @test
     */
    public function a_valid_region_does_not_throw_an_invalid_argument_exception()
    {
        $this->assertInstanceOf(Converter::class, new Converter('us'));
        $this->assertInstanceOf(Converter::class, new Converter('eu'));
        $this->assertInstanceOf(Converter::class, new Converter('es'));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function an_invalid_region_throws_an_invalid_argument_exception()
    {
        $converter = new Converter('invalid');
    }
}
