<?php

namespace WDConverter;

use InvalidArgumentException;
use OutOfRangeException;
use WDConverter\Services\EsConverter;
use WDConverter\Services\EuConverter;
use WDConverter\Services\UsConverter;

class Converter
{
    /**
     * Converter implementation
     *
     * @var WDConverter\Contracts\RegionalConverterContract
     */
    protected $regional_converter;

    /**
     * Create a new instance.
     *
     * @param string $region
     * @return void
     */
    public function __construct($region = 'us')
    {
        // Must be a valid region
        if (!in_array($region, ['es', 'eu', 'us'])) {
            throw new InvalidArgumentException('Invalid region. Input was: ' . $region);
        }

        // Init converter based on region
        switch ($region) {
            case 'es':
                $this->regional_converter = new EsConverter();
                break;
            case 'eu':
                $this->regional_converter = new EuConverter();
                break;
            default:
                $this->regional_converter = new UsConverter();
       }
    }

    /**
     * Convert a number to its string representation
     *
     * @param  int $number
     * @return string
     */
    public function int2str($number)
    {
        // Must be an integer
        if (!is_int($number)) {
            throw new InvalidArgumentException('This method only accepts integers. Input was: ' . $number);
        }

        // Must be within range (< 10^18)
        $max = pow(10, 18);
        if (abs($number) >= $max) {
            throw new OutOfRangeException('This method only accepts integers between -' . ($max - 1) . ' and ' . ($max - 1) . '. Input was: ' . $number);
        }

        // All good, convert to string
        return $this->regional_converter->int2str($number);
    }
}
