<?php

namespace App\Events\Exceptions;


class InvalidEventFormat extends \Exception
{
    protected $message = 'Invalid event format';
}