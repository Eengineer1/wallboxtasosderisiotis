<?php

declare(strict_types=1);

namespace Kata\Tests\Unit\EVs;

use Kata\Parser\CommandParser;
use Kata\ElectricVehicle\Command\{MoveForwardCommand,RotateLeftCommand,RotateRightCommand};
use Kata\Exceptions\InvalidCommandException;
use PHPUnit\Framework\TestCase;

class CommandParserTest extends TestCase
{
    /**
     * 
     * @throws InvalidCommandException
     */
    public function testShouldBreakExecutionWhenInvalidCommandIsParsed()
    {
        $command='MLMFRA';
        $this->expectException(InvalidCommandException::class);
        CommandParser::parseFromString($command);
    }

    /**
     * @throws InvalidCommandException
     */
    public function testShouldReturnArrayOfCommandInstances()
    {
        $command='MLR';
        $commandsarray=CommandParser::parseFromString($command);

        $this->assertTrue(is_array($commandsarray));
        $this->assertInstanceOf(MoveForwardCommand::class,$commandsarray[0]);
        $this->assertInstanceOf(RotateLeftCommand::class,$commandsarray[1]);
        $this->assertInstanceOf(RotateRightCommand::class,$commandsarray[2]);
    }
}
