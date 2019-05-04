<?php

namespace App\User\Repositories;


use App\Models\SocialType;

interface UserRepositoryInterface
{
    public function findBySocialIdAndType(int $id, SocialType $type);

    public function create(array $user);
}