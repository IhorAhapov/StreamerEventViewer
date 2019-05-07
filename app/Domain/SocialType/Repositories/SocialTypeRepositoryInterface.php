<?php

namespace App\Domain\SocialType\Repositories;


use App\Models\SocialType;

interface SocialTypeRepositoryInterface
{
    /**
     * Find social type by name
     *
     * @param string $name
     * @return SocialType
     */
    public function findByName(string $name) : SocialType;

    /**
     * Get all social types
     *
     * @return array
     */
    public function getAll() : array;
}