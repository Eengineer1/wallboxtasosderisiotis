<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Navigation\Coordinates;
use Kata\Navigation\Area\City;
use Kata\Exceptions\InvalidAreaBoundingCoordinatesException;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    public $x=1;

    public $y=1;

    /**
     * @var City
     */
    public $instance;

    /**
     * @var Coordinates
     */
    public function setUp(): void
    {
        $this->coordinates=new Coordinates($this->x,$this->y);
        $this->instance=new City($this->coordinates);
    }

    /**
     * @throws InvalidAreaBoundingCoordinatesException
     */
    public function testShouldBreakExecutionWhenXIsLowerThanOne()
    {
        $this->expectException(InvalidAreaBoundingCoordinatesException::class);
        $coordinates=new Coordinates(0,5);
        $this->instance=new City($coordinates);
    }

    /**
     * @throws InvalidAreaBoundingCoordinatesException
     */
    public function testShouldBreakExecutionWhenYIsLowerThanOne()
    {
        $this->expectException(InvalidAreaBoundingCoordinatesException::class);
        $coordinates=new Coordinates(5,0);
        $this->instance=new City($coordinates);
    }

    public function testShouldInitializeWithXandYPoints()
    {
        $this->assertEquals($this->coordinates,$this->instance->upperright);
        $this->assertEquals(new Coordinates(0,0),$this->instance->bottomleft);
    }

    public function testShouldValidateCoordinatesOnAGivenCityInstance(){
        $this->assertTrue($this->instance->isValidPair(new Coordinates(1,1)));
        $this->assertFalse($this->instance->isValidPair(new Coordinates(2,2)));
    }

    public function testShouldReturnUpperXFromCityInstance()
    {
        $this->assertEquals($this->x,$this->instance->getUpperX());
    }

    public function testShouldReturnUpperYFromCityInstance()
    {
        $this->assertEquals($this->y,$this->instance->getUpperY());
    }
}