<?php

namespace App\Events\Services;


use App\Models\Channel;

interface EventServiceInterface
{
    public function store(array $event) : bool;
    public function getByChannel(Channel $channel) : array;
}