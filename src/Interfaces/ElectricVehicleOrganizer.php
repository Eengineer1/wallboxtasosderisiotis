<?php

namespace Kata\Interfaces;

interface ElectricVehicleOrganizer {
    /**
     * Returns all parsed EVs
     * @return ElectricVehicle[]
     */
    public function getEVs(): array;

    /**
     * Add a new EV to the interface
     * @param ElectricVehicle $ev
     * @return ElectricVehicleOrganizer
     */
    public function addEV(ElectricVehicle $ev): self;

    /**
     * Deploys all given EVs in queue
     * @return ElectricVehicleOrganizer
     */
    public function deploy(): self;

    /**
     * Validates the eligibility of deployment for an EV given successfull deployment of the previous ones
     * @param Coordinates $currentevcoordinates
     * @param Coordinates $comparedevcoordinates
     * @return bool
     */
    public static function isEligible($currentevcoordinates,$comparedevcoordinates): bool;

    /**
     * Get the locations of all deployed vehicles
     * @return array
     */
    public function getEVLocations(): array;

    /**
     * Get the current registered area
     * @return Area
     */
    public function getArea(): Area;

}