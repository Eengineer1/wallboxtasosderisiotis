<?php

namespace Kata\Interfaces;

interface Command {
    /**
     * Execute a command on a single EV
     * @param ElectricVehicle $vehicle
     */
    public function execute(ElectricVehicle $vehicle): void;
}