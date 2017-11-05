<?php

namespace WDConverter\Services;

use WDConverter\Contracts\RegionalParserContract;

class EsParser implements RegionalParserContract
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
        $ones     = ['cero', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
        $teens    = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieceseis', 'diecesiete', 'dieceocho', 'diecenueve'];
        $twenties = ['veinte', 'veintiuno', 'veintidos', 'veintitres', 'veinticuatro', 'veinticinco', 'veintiseis', 'veintisiete', 'veintiocho', 'veintinueve'];
        $tens     = ['treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
        $hundreds = ['ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

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
                        } elseif ($v < 3) {
                            // This number represents a value in the twenties
                            $output = $twenties[$units[0]];
                        } else {
                            // This number represents a value in the tens
                            $output = $tens[$v - 3] . (($units[0] > 0) ? (' y ' . $output) : '');
                        }
                    }
                    break;
                case 2:
                    // If the third digit is 0, parsing is complete
                    if ($v > 0) {
                        if (($v == 1) and ($units[0] == 0) and ($units[1] == 0)) {
                            // Value should just be that for 100
                            $output = 'cien';
                        } else {
                            // This number represents a value in the hundreds
                            $output = $hundreds[$v - 1] . ((($units[0] > 0) or ($units[1] > 0)) ? (' ' . $output) : '');
                        }
                    }
                    break;
            }
        }

        return $output;
    }
}
