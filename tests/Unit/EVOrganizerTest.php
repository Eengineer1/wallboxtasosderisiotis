<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Interfaces\Area;
use Kata\Parser\CommandParser;
use Kata\Navigation\{Coordinates,Location};
use Kata\Navigation\Orientation\{North};
use Kata\Navigation\Area\City;
use Kata\ElectricVehicle\EV;
use Kata\EVOrganizer;
use Kata\Exceptions\{InvalidAreaBoundingCoordinatesException,InvalidResultingPositionException};
use PHPUnit\Framework\TestCase;

class EVOrganizerTest extends TestCase
{
    /**
     * @var EVOrganizer
     */
    public $instance;

    /**
     * @var Area
     */
    public $area;

    /**
     * @throws InvalidAreaBoundingCoordinatesException
     */
    public function setUp(): void
    {
        $this->area=new City(new Coordinates(5,5));
        $this->instance=new EVOrganizer($this->area);
    }

    public function testShouldBeAttachedToTheCurrentWorkingCity()
    {
        $this->assertEquals($this->area,$this->instance->area);
    }

    public function testShouldBeAbleToReturnArea()
    {
        $this->assertEquals($this->area,$this->instance->getArea());
    }

    public function testShouldBeAbleToReturnTheAddedEVs()
    {
        $this->assertEquals([],$this->instance->getEVs());
    }

    public function testShouldBeAbleToAddEVs()
    {
        $ev=new EV($this->area,new Location(new Coordinates(1,2),new North()),CommandParser::parseFromString('LM'));
        $this->instance->addEV($ev);
        $this->assertCount(1,$this->instance->getEVs());
    }

    public function testShouldBeAbleToExecuteCommandsForAnEV()
    {
        $evmock=$this
                ->getMockBuilder(EV::class)
                ->disableOriginalConstructor()
                ->getMock();

        $evmock
                ->expects($this->once())
                ->method('executeCommands');

        $this->instance->addEV($evmock);
        $this->instance->deploy();
    }

    /**
     * @throws InvalidResultingPositionException
     */
    public function testShouldBreakExecutionWhenACommandForAnEVResultsToAnAlreadyTakenPosition()
    {
        $this->expectException(InvalidResultingPositionException::class);
        $ev1=new EV($this->area,new Location(new Coordinates(1,2),new North()),CommandParser::parseFromString('LMLMLMLMM'));
        $ev2=new EV($this->area,new Location(new Coordinates(1,3),new North()),CommandParser::parseFromString('LM'));
        $this->instance->addEV($ev1);
        $this->instance->addEV($ev2);
        $this->instance->deploy();
    }

    public function testShouldBeAbleToGetPositionsOfEVs()
    {
        $evmock=$this
                ->getMockBuilder(EV::class)
                ->disableOriginalConstructor()
                ->getMock();

        $evmock
                ->expects($this->once())
                ->method('executeCommands');

        $this->instance->addEV($evmock);
        $this->instance->deploy();
        $locations=$this->instance->getEVLocations();
        $this->assertCount(1,$locations);
    }
}