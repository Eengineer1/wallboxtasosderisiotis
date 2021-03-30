<?php

namespace Kata\Navigation\Orientation;

use Kata\Interfaces\Orientation;

class West implements Orientation {

    /**
     * Get self description
     * @return string
     */
    public static function getCharName(): string
    {
        return 'W';
    }

    /**
     * Get orientation after rotating to the left, which means South
     */
    public function rotateLeft(): Orientation
    {
        return new South();
    }

    /**
     * Get orientation after rotating to the right, which means North
     */
    public function rotateRight(): Orientation
    {
        return new North();
    }
}