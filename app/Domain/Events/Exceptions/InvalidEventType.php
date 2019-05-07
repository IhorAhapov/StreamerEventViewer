<?php

namespace App\Domain\Events\Exceptions;


use Exception;

class InvalidEventType extends Exception
{
    protected $message = 'Unsupported event type';
}