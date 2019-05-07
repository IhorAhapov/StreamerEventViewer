<?php

namespace App\Streamer\Repositories;


use App\Models\Streamer;
use App\Models\User;

interface StreamerRepositoryInterface
{
    public function create(Streamer $streamer) : Streamer;
    public function delete(Streamer $streamer) : bool;
    public function getAll() : array;
    public function getById(int $id) : Streamer;
    public function setUser(User $user) : void;
}