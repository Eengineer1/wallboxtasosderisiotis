<?php

namespace Kata\Interfaces;

use Kata\Navigation\Coordinates;

interface Area {
    /**
     * Get the upper x limit of the defined area
     * @return int
     */
    public function getUpperX(): int;

    /**
     * Get the upper y limit of the defined area
     * @return int
     */
    public function getUpperY(): int;

    /**
     * Validate given coordinate pair
     * @param Coordinates $coordinates
     * @return bool
     */
    public function isValidPair(Coordinates $coordinates): bool;
}