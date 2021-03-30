<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Parser\OrientationParser;
use Kata\Navigation\Orientation\{North,East,South,West};
use PHPUnit\Framework\TestCase;
use Kata\Exceptions\InvalidOrientationException;

class OrientationParserTest extends TestCase
{
    /**
     * @throws InvalidOrientationException
     */
    public function testShouldBreakExecutionWhenInvalidOrientationIsParsed()
    {
        $this->expectException(InvalidOrientationException::class);
        $orientation=OrientationParser::parseFromString('L');
    }

    /**
     * @throws InvalidOrientationException
     */
    public function testShouldReturnInstanceOfNorthWhenNisParsed()
    {
        $this->assertInstanceOf(North::class,OrientationParser::parseFromString('N'));
    }

    /**
     * @throws InvalidOrientationException
     */
    public function testShouldReturnInstanceOfEastWhenEisParsed()
    {
        $this->assertInstanceOf(East::class,OrientationParser::parseFromString('E'));
    }

    /**
     * @throws InvalidOrientationException
     */
    public function testShouldReturnInstanceOfSouthWhenSisParsed()
    {
        $this->assertInstanceOf(South::class,OrientationParser::parseFromString('S'));
    }

    /**
     * @throws InvalidOrientationException
     */
    public function testShouldReturnInstanceOfWestWhenWisParsed()
    {
        $this->assertInstanceOf(West::class,OrientationParser::parseFromString('W'));
    }
}