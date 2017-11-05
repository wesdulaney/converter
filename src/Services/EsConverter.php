<?php

namespace WDConverter\Services;

use WDConverter\Contracts\RegionalConverterContract;
use WDConverter\Contracts\RegionalParserContract;

class EsConverter implements RegionalConverterContract
{
    /**
     * \WDConverter\Contracts\RegionalParserContract implementation
     *
     * @var object
     */
    protected $parser;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Set parser
        $this->parser = new EsParser();
    }

    /**
     * Convert a number to its string representation
     *
     * @param  int $number
     * @return string|NULL
     */
    public function int2str($number)
    {
        // Helper
        $units = [null, 'mil', 'millon', 'mil millones', 'billon', 'mil billones'];

        $output = '';

        // Convert input to a string, reverse it and split it into groups of three characters
        $string     = strrev(strval(abs($number)));
        $groups     = str_split($string, 3);
        $num_groups = count($groups);

        foreach ($groups as $k => $v) {
            // Parse the current group
            $parsed = $this->parser->intGroup($v);

            // Check for zero which is only allowed if there is only 1 group
            if (($num_groups > 1) and ($parsed == 'cero')) {
                continue;
            }

            // Determine if we need to use the plural version for the unit
            $plural = ($parsed != 'uno');

            // Add units for all groups after the first one
            if ($k > 0) {
                $parsed .= ' ' . $units[$k];
            }

            // Pluralize value?
            if ($plural and in_array($units[$k], ['millon', 'billon'])) {
                $parsed .= 'es';
            }

            // Add parsed value to output
            $output = $parsed . ' ' . $output;
        }

        // Cleanup
        $output = str_replace(['uno bil', 'uno mil'], ['un bil', 'un mil'], $output);

        // Cleanup
        $output = trim($output);

        // Prepend case?
        if ($number < 0) {
            $output = 'menos ' . $output;
        }

        return $output;
    }
}
