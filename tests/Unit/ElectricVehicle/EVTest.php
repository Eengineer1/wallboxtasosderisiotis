<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Parser\CommandParser;
use Kata\Navigation\{Coordinates,Location};
use Kata\Navigation\Orientation\{North,East,West};
use Kata\Navigation\Area\City;
use Kata\ElectricVehicle\EV;
use Kata\Exceptions\InvalidCommandException;
use Kata\Exceptions\InvalidAreaBoundingCoordinatesException;
use PHPUnit\Framework\TestCase;

class EVTest extends TestCase
{
    /**
     * @var EV
     */
    public $instance;

    /**
     * @var Location
     */
    public $location;

    /**
     * @throws InvalidCommandException
     * @throws InvalidAreaBoundingCoordinatesException
     */
    public function setUp(): void
    {
        $area=new City(new Coordinates(5,5));
        $this->location=new Location(new Coordinates(1,2),new North());

        $this->instance=new EV($area,$this->location,CommandParser::parseFromString('LMLMLMLMM'));
    }

    public function testShouldBeAbleToGetTheCurrentLocationOfTheEVInstance()
    {
        $this->assertEquals($this->location,$this->instance->getCurrentLocation());
    }

    public function testShouldBeAbleToRotateLeft()
    {
        $this->instance->rotateLeft();
        $this->assertEquals(new Location(new Coordinates(1,2),new West()),$this->instance->getCurrentLocation());
    }

    public function testShouldBeAbleToRotateRight()
    {
        $this->instance->rotateRight();
        $this->assertEquals(new Location(new Coordinates(1,2),new East()),$this->instance->getCurrentLocation());
    }

    /**
     * @throws \Exception
     */
    public function testShouldBreakExecutionWhenTryingToMoveOutOfCityBounds()
    {
        $this->expectException(\Exception::class);
        $this->instance->move()->move()->move()->move();
    }

    public function testShouldBeAbleToMoveToNextCoordinatePairBasedOnNextCommand()
    {
        $this->instance->rotateLeft()->move();
        $this->assertEquals(new Location(new Coordinates(0,2),new West()),$this->instance->getCurrentLocation());
    }

    public function testShouldBeAbleToExecuteParsedCommands()
    {
        $this->instance->executeCommands();
        $this->assertEquals(new Location(new Coordinates(1,3),new North()),$this->instance->getCurrentLocation());
    }
}