<?php

namespace App\User\Repositories;


use App\Models\SocialType;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function findBySocialIdAndType(int $id, SocialType $type)
    {
        return User::where([['social_id', $id], ['social_type_id', $type->id]])->first();
    }

    public function create(array $user)
    {
        return User::create($user);
    }
}