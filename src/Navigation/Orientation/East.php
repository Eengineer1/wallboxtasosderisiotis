<?php

namespace Kata\Navigation\Orientation;

use Kata\Interfaces\Orientation;

class East implements Orientation {

    /**
     * Get self description
     * @return string
     */
    public static function getCharName(): string
    {
        return 'E';
    }

    /**
     * Get orientation after rotating to the left, which means North
     */
    public function rotateLeft(): Orientation
    {
        return new North();
    }

    /**
     * Get orientation after rotating to the right, which means South
     */
    public function rotateRight(): Orientation
    {
        return new South();
    }
}