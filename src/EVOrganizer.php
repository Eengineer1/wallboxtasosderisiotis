<?php

namespace Kata;

use Kata\Interfaces\{Area,ElectricVehicle,ElectricVehicleOrganizer};
use Kata\Exceptions\InvalidResultingPositionException;

class EVOrganizer implements ElectricVehicleOrganizer
{
    public $area;

    /**
     * @var ElectricVehicle[]
     */
    private $evs=[];

    /**
     * EVOrganizer constructor
     * @param Area $area
     */
    public function __construct(Area $area)
    {
        $this->area=$area;
    }

    /**
     * Return the current area
     * @return Area
     */
    public function getArea(): Area
    {
        return $this->area;
    }

    /**
     * Return the EVs added
     * @return ElectricVehicle[]
     */
    public function getEVs(): array
    {
        return $this->evs;
    }

    /**
     * Add an EV to the organizer
     * @param ElectricVehicle $ev
     * @return ElectricVehicleOrganizer
     */
    public function addEV(ElectricVehicle $ev): ElectricVehicleOrganizer
    {
        if(!$ev->getCurrentLocation()->isTaken($this->getEVLocations())){
            $this->evs[]=$ev;
        }
        return $this;
    }

    /**
     * Deploys all given EVs in queue
     * @throws InvalidResultingPositionException
     * @return ElectricVehicleOrganizer
     */
    public function deploy(): ElectricVehicleOrganizer
    {
        for($i=0;$i<count($this->evs);$i++){
            if($i>0){
                $currentevcoordinates=$this->evs[$i]->getCurrentLocation()->getCoordinates();
                for($k=0;$k<$i;$k++){
                    $comparedevcoordinates=$this->evs[$k]->getCurrentLocation()->getCoordinates();
                    if(!EVOrganizer::isEligible($currentevcoordinates,$comparedevcoordinates)){
                        throw new InvalidResultingPositionException();
                    }
                }
            }
            $this->evs[$i]->executeCommands();
        }
        return $this;
    }

    /**
     * Validates the eligibility of deployment for an EV given successfull deployment of the previous ones
     * @param Coordinates $currentevcoordinates
     * @param Coordinates $comparedevcoordinates
     * @return bool
     */
    public static function isEligible($currentevcoordinates,$comparedevcoordinates): bool
    {
        $currentevX=$currentevcoordinates->getX();
        $currentevY=$currentevcoordinates->getY();
        $comparedevX=$comparedevcoordinates->getX();
        $comparedevY=$comparedevcoordinates->getY();
        if($currentevX==$comparedevX and $currentevY==$comparedevY){
            return false;
        }
        return true;
    }

    /**
     * Get the EVs locations
     * @return array
     */
    public function getEVLocations(): array
    {
        $locations=[];
        foreach($this->evs as $ev){
            $locations[]=$ev->getCurrentLocation();
        }
        return $locations;
    }
}