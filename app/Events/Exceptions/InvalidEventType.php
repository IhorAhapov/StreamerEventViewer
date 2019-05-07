<?php

namespace App\Events\Exceptions;


use Exception;

class InvalidEventType extends Exception
{
    protected $message = 'Unsupported event type';
}