<?php

namespace Kata\Parser;

use Kata\Exceptions\InvalidCommandException;
use Kata\ElectricVehicle\Command\{MoveForwardCommand,RotateLeftCommand,RotateRightCommand};

class CommandParser
{
    /**
     * Valid commands
     * @var array
     */
    private static $validcommands=[
        'M'=>MoveForwardCommand::class,
        'L'=>RotateLeftCommand::class,
        'R'=>RotateRightCommand::class,
    ];

    /**
     * Parse commands from input string
     * @param $inputstring
     * @return array
     * @throws InvalidCommandException
     */
    public static function parseFromString($inputstring): array
    {
        $commands=[];
        $strsplit=str_split($inputstring);
        foreach($strsplit as $s){
            if(!self::isValid($s)){
                throw new InvalidCommandException();
            }
            $commands[]=new self::$validcommands[$s];
        }
        return $commands;
    }

    /**
     * Validate char name of command from input
     * @param $char
     * @return bool
     */
    private static function isValid($char): bool
    {
        return array_key_exists($char,self::$validcommands);
    }
}