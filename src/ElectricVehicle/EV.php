<?php

namespace Kata\ElectricVehicle;

use Kata\Exceptions\InvalidPositionException;
use Kata\Interfaces\{Command,Area,ElectricVehicle};
use Kata\Navigation\Location;

class EV implements ElectricVehicle
{
    /**
     * @var Area
     */
    private $area;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var Command[]
     */
    private $commands;

    public function __construct(Area $area,Location $location,array $commands)
    {
        $this->area=$area;
        $this->location=$location;
        $this->commands=$commands;
    }

    /**
     * Return the current location of the EV
     * @return Location
     */
    public function getCurrentLocation(): Location
    {
        return $this->location;
    }

    /**
     * Rotate 90 degrees to the left
     * @return ElectricVehicle
     */
    public function rotateLeft(): ElectricVehicle
    {
        $this->location->rotateLeft();
        return $this;
    }

    /**
     * Rotate 90 degrees to the right
     * @return ElectricVehicle
     */
    public function rotateRight(): ElectricVehicle
    {
        $this->location->rotateRight();
        return $this;
    }

    /**
     * Move forwards the EV
     * @return ElectricVehicle
     * @throws InvalidPositionException
     */
    public function move(): ElectricVehicle
    {
        $resultingcoordinates=$this->location->getResultingCoordinates();
        if(!$this->area->isValidPair($resultingcoordinates)){
            throw new InvalidPositionException();
        }
        $this->location->updateCoordinates($resultingcoordinates);
        return $this;
    }

    /**
     * Execute the given commands for the EV
     * @return ElectricVehicle
     */
    public function executeCommands(): ElectricVehicle
    {
        foreach($this->commands as $command){
            $command->execute($this);
        }
        return $this;
    }
}