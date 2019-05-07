<?php

namespace App\Domain\Streamer;


use App\Domain\Streamer\Exceptions\InvalidStreamerArray;
use App\Models\User;
use App\Models\Streamer;

class StreamerFactory
{
    public static function makeFromArray(array $data, User $user = null): Streamer
    {
        if (!isset($data['id']) || !isset($data['display_name'])) {
            throw new InvalidStreamerArray();
        }

        $streamer = new Streamer([
            'streamer_id' => $data['id'],
            'name' => $data['display_name']
        ]);

        if ($user) {
            $streamer->user_id = $user->id;
        }

        return $streamer;
    }
}