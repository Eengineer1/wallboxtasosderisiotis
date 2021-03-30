<?php

namespace Kata\Exceptions;

class InvalidCommandException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The provided command is invalid. Valid commands are L, R, M.');
    }
}