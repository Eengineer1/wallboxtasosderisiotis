<?php

namespace Kata\Navigation\Orientation;

use Kata\Interfaces\Orientation;

class North implements Orientation {

    /**
     * Get self description
     * @return string
     */
    public static function getCharName(): string
    {
        return 'N';
    }

    /**
     * Get orientation after rotating to the left, which means West
     */
    public function rotateLeft(): Orientation
    {
        return new West();
    }

    /**
     * Get orientation after rotating to the right, which means East
     */
    public function rotateRight(): Orientation
    {
        return new East();
    }
}