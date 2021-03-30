<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Navigation\Coordinates;
use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{
    private $x=1;
    private $y=2;

    /**
     * @var Coordinates
     */
    private $instance;

    public function setUp(): void
    {
        $this->instance=new Coordinates($this->x,$this->y);
    }

    public function testShouldInitializeInstanceWithXY()
    {
        $this->assertEquals($this->x,$this->instance->x);
        $this->assertEquals($this->y,$this->instance->y);
    }

    public function testShouldReturnX()
    {
        $this->assertEquals($this->x,$this->instance->getX());
    }

    public function testShouldReturnY()
    {
        $this->assertEquals($this->y,$this->instance->getY());
    }
}