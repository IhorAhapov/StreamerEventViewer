<?php

namespace App\Streamer\Exceptions;


class StreamerNotFound extends \Exception
{
    protected $message = "Channel not found.";
}