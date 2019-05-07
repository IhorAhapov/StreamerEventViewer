<?php

namespace App\Streamer\Services;


use App\Models\Streamer;

interface StreamerServiceInterface
{
    public function saveToFavorite(string $name) : bool;
    public function delete(Streamer $streamer) : bool;
    public function getAllStreamers() : array;
    public function getByStreamerId(int $id) : Streamer;
}