<?php

namespace App\Domain\SocialType\Repositories;


use App\Models\SocialType;

class SocialTypeRepository implements SocialTypeRepositoryInterface
{
    public function findByName(string $name): SocialType
    {
        return SocialType::where('name', $name)->firstOrFail();
    }

    public function getAll(): array
    {
        return SocialType::all()->toArray();
    }
}