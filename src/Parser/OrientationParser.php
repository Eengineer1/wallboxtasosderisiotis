<?php

namespace Kata\Parser;

use Kata\Exceptions\InvalidOrientationException;
use Kata\Interfaces\Orientation;
use Kata\Navigation\Orientation\{North,East,South,West};

class OrientationParser
{
    private static $orientations=[
        'N'=>North::class,
        'E'=>East::class,
        'S'=>South::class,
        'W'=>West::class,
    ];

    /**
     * Parse orientation commands from input string
     * @param $char
     * @return Orientation
     * @throws InvalidOrientationException
     */
    public static function parseFromString($char): Orientation
    {
        if(!array_key_exists($char,self::$orientations)){
            throw new InvalidOrientationException();
        }
        return new self::$orientations[$char];
    }
}