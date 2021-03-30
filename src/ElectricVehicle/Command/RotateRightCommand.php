<?php

namespace Kata\ElectricVehicle\Command;

use Kata\Interfaces\{Command,ElectricVehicle};

class RotateRightCommand implements Command
{
    public function execute(ElectricVehicle $ev): void
    {
        $ev->rotateRight();
    }
}