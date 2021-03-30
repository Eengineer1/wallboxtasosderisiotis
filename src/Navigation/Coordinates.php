<?php

namespace Kata\Navigation;

class Coordinates
{
    /**
     * The x axis coordinate
     * @var int
     */
    public $x;

    /**
     * The y axis coordinate
     * @var int
     */
    public $y;

    /**
     * The Coordinates constructor
     * @param $x
     * @param $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x=$x;
        $this->y=$y;
    }

    /**
     * Get the x coordinate value
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Get the y coordinate value
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}