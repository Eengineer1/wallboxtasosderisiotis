<?php

namespace Kata\Navigation\Area;

use Kata\Exceptions\InvalidAreaBoundingCoordinatesException;
use Kata\Interfaces\Area;
use Kata\Navigation\Coordinates;

class City implements Area 
{
    /**
     * The bottom left limit of the defined area, usually (0,0)
     * @var Coordinates
     */
    public $bottomleft;

    /**
     * The upper right limit of the defined area
     * @var Coordinates
     */
    public $upperright;

    /**
     * City constructor
     * @param Coordinates $upperright
     * @throws InvalidAreaBoundingCoordinatesException
     */
    public function __construct(Coordinates $upperright)
    {
        if($upperright->getX()<1 or $upperright->getY()<1){
            throw new InvalidAreaBoundingCoordinatesException();
        }
        $this->upperright=$upperright;
        $this->bottomleft=new Coordinates(0,0);
    }

    /**
     * Get upper right x coord
     * @return int
     */
    public function getUpperX(): int
    {
        return $this->upperright->getX();
    }

    /**
     * Get upper right y coord
     * @return int
     */
    public function getUpperY(): int
    {
        return $this->upperright->getY();
    }

    /**
     * Validate given pair
     * @param Coordinates $coordinates
     * @return bool
     */
    public function isValidPair(Coordinates $coordinates): bool
    {
        $x=$coordinates->getX();
        $y=$coordinates->getY();
        return ($x<=$this->upperright->getX() and $x>=0) and ($y<=$this->upperright->getY() and $y>=0);
    }
}