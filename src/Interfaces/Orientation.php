<?php

namespace Kata\Interfaces;

interface Orientation {
    /**
     * Get the char name of the Orientation Class
     * @return string
     */
    public static function getCharName(): string;

    /**
     * Get the orientation when a rotation to the left happens
     * @return Orientation
     */
    public function rotateLeft(): self;
    
    /**
     * Get the orientation when a rotation to the right happens
     * @return Orientation
     */
    public function rotateRight(): self;
}