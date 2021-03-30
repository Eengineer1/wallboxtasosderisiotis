<?php

namespace Kata\Exceptions;

class InvalidAreaBoundingCoordinatesException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The provided upper right coordinate pair is invalid.');
    }
}