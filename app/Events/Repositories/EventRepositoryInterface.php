<?php

namespace App\Events\Repositories;


use App\Models\Event;
use App\Models\Streamer;

interface EventRepositoryInterface
{
    public function create(Event $event, Streamer $streamer) : bool;
    public function getByStreamer(Streamer $streamer, int $count) : array;
}