<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Navigation\Orientation\{North,East,West};
use PHPUnit\Framework\TestCase;

class NorthTest extends TestCase
{
    /**
     * @var North
     */
    public $instance;

    public function setUp():void
    {
        $this->instance=new North();
    }

    public function testShouldOrientateToWestWhenRotatedLeft()
    {
        $this->assertInstanceOf(West::class,$this->instance->rotateLeft());
    }

    public function testShouldOrientateToEastWhenRotatedRight()
    {
        $this->assertInstanceOf(East::class,$this->instance->rotateRight());
    }

    public function testShouldReturnSelfDescriptionCharNameOfClass()
    {
        $this->assertEquals('N',$this->instance->getCharName());
    }
}