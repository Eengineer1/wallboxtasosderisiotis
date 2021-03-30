<?php

namespace Kata\Navigation\Orientation;

use Kata\Interfaces\Orientation;

class South implements Orientation {

    /**
     * Get self description
     * @return string
     */
    public static function getCharName(): string
    {
        return 'S';
    }

    /**
     * Get orientation after rotating to the left, which means East
     */
    public function rotateLeft(): Orientation
    {
        return new East();
    }

    /**
     * Get orientation after rotating to the right, which means West
     */
    public function rotateRight(): Orientation
    {
        return new West();
    }
}