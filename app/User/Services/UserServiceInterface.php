<?php

namespace App\User\Services;


use App\Models\User;
use SocialiteProviders\Manager\OAuth2\User as SocialUser;

interface UserServiceInterface
{
    public function findOrCreateFromSocial(SocialUser $socialUser, string $provider) : User;
}