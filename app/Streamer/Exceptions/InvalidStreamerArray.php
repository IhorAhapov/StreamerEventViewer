<?php

namespace App\Streamer\Exceptions;


class InvalidStreamerArray extends \Exception
{
    protected $message = "Invalid streamer array received.";
}