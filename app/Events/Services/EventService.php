<?php

namespace App\Events\Services;


use App\Models\Channel;

class EventService implements EventServiceInterface
{

    public function store(array $event): bool
    {
        // TODO: Implement store() method.
    }

    public function getByChannel(Channel $channel): array
    {
        // TODO: Implement getByChannel() method.
    }
}