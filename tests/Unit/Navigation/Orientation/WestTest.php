<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Navigation\Orientation\{North,South,West};
use PHPUnit\Framework\TestCase;

class WestTest extends TestCase
{
    /**
     * @var West
     */
    public $instance;

    public function setUp():void
    {
        $this->instance=new West();
    }

    public function testShouldOrientateToSouthWhenRotatedLeft()
    {
        $this->assertInstanceOf(South::class,$this->instance->rotateLeft());
    }

    public function testShouldOrientateToNorthWhenRotatedRight()
    {
        $this->assertInstanceOf(North::class,$this->instance->rotateRight());
    }

    public function testShouldReturnSelfDescriptionCharNameOfClass()
    {
        $this->assertEquals('W',$this->instance->getCharName());
    }
}