<?php

namespace Kata\Exceptions;

class InvalidResultingPositionException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The resulting position for the provided EV is taken by another EV. Try another command combination within the city bounds.');
    }
}