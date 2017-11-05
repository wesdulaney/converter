<?php

namespace WDConverter\Contracts;

/**
 * Interface for defining regional converters
 *
 * method int int2str($number)
 */
interface RegionalConverterContract
{
    /**
     * Convert a number to its string representation
     *
     * @param  int $number
     * @return string
     */
    public function int2str($number);
}
