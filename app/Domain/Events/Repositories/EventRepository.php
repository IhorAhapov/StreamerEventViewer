<?php

namespace App\Domain\Events\Repositories;


use App\Models\Event;
use App\Models\Streamer;

class EventRepository implements EventRepositoryInterface
{

    public function create(Event $event, Streamer $streamer): bool
    {
        return (bool)$streamer->events()->save($event);
    }

    public function getByStreamer(Streamer $streamer, int $count): array
    {
        return $streamer->events->sortByDesc('id')->take($count)->toArray();
    }
}