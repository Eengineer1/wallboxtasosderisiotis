<?php

namespace Kata\ElectricVehicle\Command;

use Kata\Interfaces\{Command,ElectricVehicle};

class MoveForwardCommand implements Command
{
    public function execute(ElectricVehicle $ev): void
    {
        $ev->move();
    }
}