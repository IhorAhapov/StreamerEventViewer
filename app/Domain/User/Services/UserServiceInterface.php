<?php

namespace App\Domain\User\Services;


use App\Models\User;
use SocialiteProviders\Manager\OAuth2\User as SocialUser;

interface UserServiceInterface
{
    /**
     * Create user by SocialUser and social provider
     *
     * @param SocialUser $socialUser
     * @param string $provider
     * @return User
     */
    public function findOrCreateFromSocial(SocialUser $socialUser, string $provider) : User;
}