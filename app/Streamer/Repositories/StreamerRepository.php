<?php

namespace App\Streamer\Repositories;


use App\Models\Streamer;
use App\Models\User;

class StreamerRepository implements StreamerRepositoryInterface
{
    private $user;

    public function create(Streamer $streamer) : Streamer
    {
        return $this->user->streamers()->firstOrCreate([
            'name' => $streamer->name,
            'streamer_id' => $streamer->streamer_id
        ]);
    }

    public function getAll(): array
    {
        return $this->user->streamers->toArray();
    }

    public function getById(int $id): Streamer
    {
        return $this->user->streamers()->findOrFail($id);
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function delete(Streamer $streamer): bool
    {
        return $streamer->delete();
    }
}