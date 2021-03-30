<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Navigation\Orientation\{East,South,West};
use PHPUnit\Framework\TestCase;

class SouthTest extends TestCase
{
    /**
     * @var South
     */
    public $instance;

    public function setUp():void
    {
        $this->instance=new South();
    }

    public function testShouldOrientateToEastWhenRotatedLeft()
    {
        $this->assertInstanceOf(East::class,$this->instance->rotateLeft());
    }

    public function testShouldOrientateToWestWhenRotatedRight()
    {
        $this->assertInstanceOf(West::class,$this->instance->rotateRight());
    }

    public function testShouldReturnSelfDescriptionCharNameOfClass()
    {
        $this->assertEquals('S',$this->instance->getCharName());
    }
}