<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Navigation\{Coordinates,Orientation,Location};
use Kata\Navigation\Orientation\{North,East,South,West};
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    /**
     * @var Coordinates
     */
    public $coordinates;

    /**
     * @var Orientation
     */
    public $orientation;

    /**
     * @var Location
     */
    public $instance;

    public function setUp(): void
    {
        $this->coordinates=new Coordinates(1,2);
        $this->orientation=new North();
        $this->instance=new Location($this->coordinates,$this->orientation);
    }

    public function testShouldReturnCoordinatesOfCurrentInstance()
    {
        $this->assertEquals($this->coordinates,$this->instance->getCoordinates());
    }

    public function testShouldReturnOrientationOfCurrentInstance()
    {
        $this->assertEquals($this->orientation,$this->instance->getOrientation());
    }

    public function testShouldHaveStringAsCommand()
    {
        $this->assertEquals('1 2 N',(string) $this->instance);
    }

    public function testShouldOrientateToWestWhenRotatedLeftFromNorth()
    {
        $this->instance->rotateLeft();
        $this->assertInstanceOf(West::class,$this->instance->getOrientation());
    }

    public function testShouldOrientateToEastWhenRotatedRightFromNorth()
    {
        $this->instance->rotateRight();
        $this->assertInstanceOf(East::class,$this->instance->getOrientation());
    }

    public function testShouldGetTheResultingCoordinatesAfterMovingNorth()
    {
        $this->assertEquals(new Coordinates(1,3),$this->instance->getResultingCoordinates());
    }

    public function testShouldGetTheResultingCoordinatesAfterMovingEast()
    {
        $this->assertEquals(new Coordinates(2,2),$this->instance->rotateRight()->getResultingCoordinates());
    }

    public function testShouldGetTheResultingCoordinatesAfterMovingWest()
    {
        $this->assertEquals(new Coordinates(0,2),$this->instance->rotateLeft()->getResultingCoordinates());
    }

    public function testShouldGetTheResultingCoordinatesAfterMovingSouth()
    {
        $this->assertEquals(new Coordinates(1,1),$this->instance->rotateLeft()->rotateLeft()->getResultingCoordinates());
    }

    public function testShouldBeAbleToUpdateCoordinatesPair()
    {
        $coordinates=new Coordinates(2,3);
        $this->instance->updateCoordinates($coordinates);
        $this->assertEquals($coordinates,$this->instance->getCoordinates());
    }

    public function testShouldReturnTrueIfAPositionIsAlreadyTakenByAnotherEV()
    {
        $locations=[];
        $locations[]=new Location(new Coordinates(1,2),new North());

        $this->assertTrue($this->instance->isTaken($locations));
    }

    public function testShouldReturnFalseIfAPositionIsNotAlreadyTakenByAnotherEV()
    {
        $locations=[];
        $locations[]=new Location(new Coordinates(3,3),new East());

        $this->assertFalse($this->instance->isTaken($locations));
    }
}