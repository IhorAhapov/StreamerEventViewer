<?php

namespace App\Domain\Streamer\Repositories;


use App\Models\Streamer;
use App\Models\User;

interface StreamerRepositoryInterface
{
    /**
     * Create new streamer
     *
     * @param Streamer $streamer
     * @return Streamer
     */
    public function create(Streamer $streamer) : Streamer;

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
    public function getAll() : array;

    /**
     * Get streamer by streamer_id
     *
     * @param int $id
     * @return Streamer
     */
    public function getByStreamerId(int $id) : Streamer;

    /**
     * Set current user
     *
     * @param User $user
     */
    public function setUser(User $user) : void;
}