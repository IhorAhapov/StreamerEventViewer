<?php

namespace App\Domain\Streamer\Exceptions;


use Exception;

class StreamerNotFound extends Exception
{
    protected $message = "Channel not found.";
}