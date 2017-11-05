<?php

namespace WDConverter\Services;

use WDConverter\Contracts\RegionalConverterContract;
use WDConverter\Contracts\RegionalParserContract;

class EuConverter implements RegionalConverterContract
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
        $this->parser = new EnParser();
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
        $units = [null, 'thousand', 'million', 'milliard', 'billion', 'billiard'];

        $output = '';

        // Convert input to a string, reverse it and split it into groups of three characters
        $string     = strrev(strval(abs($number)));
        $groups     = str_split($string, 3);
        $num_groups = count($groups);

        foreach ($groups as $k => $v) {
            // Parse the current group
            $parsed = $this->parser->intGroup($v);

            // Check for zero which is only allowed if there is only 1 group
            if (($num_groups > 1) and ($parsed == 'zero')) {
                continue;
            }

            // Add units for all groups after the first one
            if ($k > 0) {
                $parsed .= ' ' . $units[$k];
            }

            // Add parsed value to output
            $output = $parsed . ' ' . $output;
        }

        // Cleanup
        $output = trim($output);

        // Prepend case?
        if ($number < 0) {
            $output = 'negative ' . $output;
        }

        return $output;
    }
}
