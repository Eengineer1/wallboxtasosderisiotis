<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Parser\CommandParser;
use Kata\Navigation\{Coordinates,Location};
use Kata\Navigation\Orientation\{North,West};
use Kata\Navigation\Area\City;
use Kata\ElectricVehicle\Command\RotateLeftCommand;
use Kata\ElectricVehicle\EV;
use Kata\Exceptions\InvalidCommandException;
use Kata\Exceptions\InvalidAreaBoundingCoordinatesException;
use PHPUnit\Framework\TestCase;

class RotateLeftCommandTest extends TestCase
{
    /**
     * @var EV
     */
    private $ev;

    /**
     * @throws InvalidCommandException
     * @throws InvalidAreaBoundingCoordinatesException
     */
    public function setUp(): void
    {
        $area=new City(new Coordinates(5,5));
        $this->ev=new EV($area,new Location(new Coordinates(1,2),new North()),CommandParser::parseFromString('M'));
    }

    public function testShouldRotateEVLeft()
    {
        $command=new RotateLeftCommand();
        $command->execute($this->ev);

        $this->assertEquals(new Location(new Coordinates(1,2),new West()),$this->ev->getCurrentLocation());
    }
}