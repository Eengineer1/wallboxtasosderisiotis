<?php

namespace Kata\Exceptions;

class InvalidOrientationException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The provided orientation is invalid. Valid orientations are N, E, S, W.');
    }
}