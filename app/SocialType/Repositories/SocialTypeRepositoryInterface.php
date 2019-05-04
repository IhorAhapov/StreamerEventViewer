<?php

namespace App\SocialType\Repositories;

use App\Models\SocialType;

interface SocialTypeRepositoryInterface
{
    public function findByName(string $name) : SocialType;
    public function getAll() : array;
}