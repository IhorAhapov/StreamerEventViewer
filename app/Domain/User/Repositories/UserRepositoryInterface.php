<?php

namespace App\Domain\User\Repositories;


use App\Models\SocialType;

interface UserRepositoryInterface
{
    /**
     * Find user by social_id and social type
     *
     * @param int $id
     * @param SocialType $type
     * @return mixed
     */
    public function findBySocialIdAndType(int $id, SocialType $type);

    /**
     * Create new user
     *
     * @param array $user
     * @return mixed
     */
    public function create(array $user);
}