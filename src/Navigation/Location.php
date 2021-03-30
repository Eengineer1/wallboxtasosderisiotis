<?php

namespace Kata\Navigation;

use Kata\Interfaces\Orientation;
use Kata\Navigation\Orientation\{North,East,South,West};
use Kata\Exceptions\InvalidPositionException;

/**
 * The Location class is used as a combo of Coordinates and Orientation for definition purposes
 */

class Location
{
    const ROTATE_LEFT=1;
    const ROTATE_RIGHT=2;

    /**
     * Coordinates of the location
     * @var Coordinates
     */
    private $coordinates;

    /**
     * Orientation of the location
     * @var Orientation
     */
    private $orientation;

    /**
     * The location constructor
     * @param Coordinates $coordinates
     * @param Orientation $orientation
     */
    public function __construct(Coordinates $coordinates,Orientation $orientation)
    {
        $this->coordinates=$coordinates;
        $this->orientation=$orientation;
    }

    /**
     * Get the current coordinates pair
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    /**
     * Get the current orientation
     * @return Orientation
     */
    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }

    /**
     * Rotate leftwise
     * @return self
     */
    public function rotateLeft(): self
    {
        $this->orientation=$this->orientation->rotateLeft();
        return $this;
    }

    /**
     * Rotate rightwise
     * @return self
     */
    public function rotateRight(): self
    {
        $this->orientation=$this->orientation->rotateRight();
        return $this;
    }

    /**
     * Get the next pair of coordinates given the orientation
     * @return Coordinates
     */
    public function getResultingCoordinates(): Coordinates
    {
        $x=$this->coordinates->getX();
        $y=$this->coordinates->getY();

        switch($this->orientation->getCharName()){
            case North::getCharName():
                $y+=1;
                break;
            case East::getCharName():
                $x+=1;
                break;
            case South::getCharName():
                $y-=1;
                break;
            case West::getCharName():
                $x-=1;
                break;
        }
        return new Coordinates($x,$y);
    }

    /**
     * Validates if the given position is already taken by another EV
     * @param Location[] $locations
     * @return bool
     * @throws InvalidPositionException
     */
    public function isTaken($locations): bool
    {
        $istaken=false;
        if(count($locations)==0){return $istaken;}
        foreach($locations as $l){
            if($l->getCoordinates()->getX()==$this->coordinates->getX() and $l->getCoordinates()->getY()==$this->coordinates->getY()){
                $istaken=true;
            }
        }
        return $istaken;
    }

    /**
     * Update coordinates with the resulting pair
     * @return Coordinates $coordinates
     */
    public function updateCoordinates(Coordinates $coordinates): void
    {
        $this->coordinates=$coordinates;
    }

    /**
     * For printing purposes
     * @return string
     */
    public function __toString(): string
    {
        return "{$this->coordinates->getX()} {$this->coordinates->getY()} {$this->orientation->getCharName()}";
    }
}