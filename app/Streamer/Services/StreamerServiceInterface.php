<?php

namespace App\Streamer\Services;


use App\Models\Streamer;

interface StreamerServiceInterface
{
    public function saveToFavorite(string $name) : bool;
    public function getAllStreamers() : array;
    public function getById(int $id) : Streamer;
}