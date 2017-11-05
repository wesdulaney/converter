<?php

namespace WDConverter\Contracts;

/**
 * Interface for defining regional parsers
 *
 * method string|NULL intGroup($group)
 */
interface RegionalParserContract
{
    /**
     * Parse a string representing a (reversed) 3-digit group of integers within a larger integer
     *
     * @param  string $group
     * @return string|NULL
     */
    public function intGroup($group);
}
