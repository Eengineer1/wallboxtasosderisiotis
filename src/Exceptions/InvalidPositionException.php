<?php

namespace Kata\Exceptions;

class InvalidPositionException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The provided position is invalid or it is taken by another EV. Try another one within the city bounds.');
    }
}