<?php

namespace Kata\Interfaces;

use Kata\Navigation\Location;

interface ElectricVehicle {
    /**
     * Get current position of the EV
     * @return Location
     */
    public function getCurrentLocation(): Location;

    /**
     * Sets the EV 90 degrees to the left
     * @return ElectricVehicle
     */
    public function rotateLeft(): self;

    /**
     * Sets the EV 90 degrees to the right
     * @return ElectricVehicle
     */
    public function rotateRight(): self;

    /**
     * Moves the EV towards the given orientation, 1 step forward
     * @return ElectricVehicle
     */
    public function move(): self;

    /**
     * Executes the given commands for the EV
     * @return ElectricVehicle
     */
    public function executeCommands(): self;
}