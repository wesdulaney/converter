<?php

namespace WDConverter\Services;

use WDConverter\Contracts\RegionalParserContract;

class EnParser implements RegionalParserContract
{
    /**
     * Parse a string representing a (reversed) 3-digit group of integers within a larger integer
     *
     * @param  string $group
     * @return string|NULL
     */
    public function intGroup($group)
    {
        // Helpers
        $ones  = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        $teens = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
        $tens  = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

        $output = null;

        // Parse group
        $units = str_split($group);
        foreach ($units as $k => $v) {
            switch ($k) {
                case 0:
                    // First digit in the group will come from the set of ones
                    $output = $ones[$v];
                    break;
                case 1:
                    // Only proceed if the second digit isn't 0
                    if ($v > 0) {
                        if ($v < 2) {
                            // This number represents a value in the teens
                            $output = $teens[$units[0]];
                        } else {
                            // This number represents a value in the tens
                            $output = $tens[$v - 2] . (($units[0] > 0) ? ('-' . $output) : '');
                        }
                    }
                    break;
                case 2:
                    // If the third digit is 0, parsing is complete
                    if ($v > 0) {
                        // This number represents a value in the hundreds
                        $output = $ones[$v] . ' hundred' . ((($units[0] > 0) or ($units[1] > 0)) ? (' ' . $output) : '');
                    }
                    break;
            }
        }

        return $output;
    }
}
