<?php

namespace App\Domain\Events\Repositories;


use App\Models\Event;
use App\Models\Streamer;

interface EventRepositoryInterface
{
    /**
     * Create new event for streamer
     *
     * @param Event $event
     * @param Streamer $streamer
     * @return bool
     */
    public function create(Event $event, Streamer $streamer) : bool;

    /**
     * Get last events for streamer
     *
     * @param Streamer $streamer
     * @param int $count
     * @return array
     */
    public function getByStreamer(Streamer $streamer, int $count) : array;
}