<?php

namespace App\Domain\Streamer\Exceptions;


use Exception;

class InvalidStreamerArray extends Exception
{
    protected $message = "Invalid streamer array received.";
}