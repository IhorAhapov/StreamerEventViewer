<?php

namespace App\Domain\Events\Exceptions;


use Exception;

class InvalidEventFormat extends Exception
{
    protected $message = 'Invalid event format';
}