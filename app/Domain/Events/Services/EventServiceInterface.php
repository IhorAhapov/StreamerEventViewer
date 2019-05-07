<?php

namespace App\Domain\Events\Services;


use App\Models\Streamer;

interface EventServiceInterface
{
    /**
     * Create new event with selected type for streamer
     *
     * @param array $event
     * @param string $type
     * @param Streamer $streamer
     * @return bool
     */
    public function store(array $event, string $type, Streamer $streamer) : bool;

    /**
     * Get last events for streamer
     *
     * @param Streamer $streamer
     * @return array
     */
    public function getByStreamer(Streamer $streamer) : array;
}