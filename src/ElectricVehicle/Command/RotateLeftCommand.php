<?php

namespace Kata\ElectricVehicle\Command;

use Kata\Interfaces\{Command,ElectricVehicle};

class RotateLeftCommand implements Command
{
    public function execute(ElectricVehicle $ev): void
    {
        $ev->rotateLeft();
    }
}