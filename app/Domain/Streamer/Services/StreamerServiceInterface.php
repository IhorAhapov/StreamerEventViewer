<?php

namespace App\Domain\Streamer\Services;


use App\Models\Streamer;

interface StreamerServiceInterface
{
    /**
     * Save streamer to favorite and init subscription
     *
     * @param string $name
     * @return bool
     */
    public function saveToFavorite(string $name) : bool;

    /**
     * Delete streamer
     *
     * @param Streamer $streamer
     * @return bool
     */
    public function delete(Streamer $streamer) : bool;

    /**
     * Get all streamer for current user
     *
     * @return array
     */
    public function getAllStreamers() : array;

    /**
     * Get streamer by streamer_id
     *
     * @param int $id
     * @return Streamer
     */
    public function getByStreamerId(int $id) : Streamer;
}