<?php

namespace App\Events\Services;


use App\Models\Streamer;

interface EventServiceInterface
{
    public function store(array $event, string $type, Streamer $streamer) : bool;
    public function getByStreamer(Streamer $streamer) : array;
}