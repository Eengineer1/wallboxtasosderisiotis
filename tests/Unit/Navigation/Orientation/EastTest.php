<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Navigation\Orientation\{North,East,South};
use PHPUnit\Framework\TestCase;

class EastTest extends TestCase
{
    /**
     * @var East
     */
    public $instance;

    public function setUp():void
    {
        $this->instance=new East();
    }

    public function testShouldOrientateToNorthWhenRotatedLeft()
    {
        $this->assertInstanceOf(North::class,$this->instance->rotateLeft());
    }

    public function testShouldOrientateToSouthWhenRotatedRight()
    {
        $this->assertInstanceOf(South::class,$this->instance->rotateRight());
    }

    public function testShouldReturnSelfDescriptionCharNameOfClass()
    {
        $this->assertEquals('E',$this->instance->getCharName());
    }
}