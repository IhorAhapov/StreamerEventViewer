<?php

namespace App\Events\Repositories;


use App\Models\Channel;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{

    public function create(Event $event): bool
    {
        // TODO: Implement create() method.
    }

    public function getByChannel(Channel $channel): array
    {
        // TODO: Implement getByChannel() method.
    }
}