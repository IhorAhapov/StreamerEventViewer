<?php

namespace App\Events\Repositories;


use App\Models\Channel;
use App\Models\Event;

interface EventRepositoryInterface
{
    public function create(Event $event) : bool;
    public function getByChannel(Channel $channel) : array;
}