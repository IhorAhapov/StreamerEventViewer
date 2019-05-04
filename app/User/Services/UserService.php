<?php

namespace App\User\Services;


use App\Models\User;
use App\SocialType\Services\SocialTypeServiceInterface;
use App\User\Repositories\UserRepositoryInterface;
use SocialiteProviders\Manager\OAuth2\User as SocialUser;

class UserService implements UserServiceInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var SocialTypeServiceInterface
     */
    private $socialTypeService;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param SocialTypeServiceInterface $socialTypeService
     */
    public function __construct(UserRepositoryInterface $userRepository, SocialTypeServiceInterface $socialTypeService)
    {
        $this->userRepository = $userRepository;
        $this->socialTypeService = $socialTypeService;
    }

    public function findOrCreateFromSocial(SocialUser $socialUser, string $provider): User
    {
        $socialType = $this->socialTypeService->findByName($provider);

        $user = $this->userRepository->findBySocialIdAndType($socialUser->getId(), $socialType);

        //if user not exist - will create new
        if (!$user) {
            $user = $this->userRepository->create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'social_type_id' => $socialType->id,
                'social_id' => $socialUser->getId()
            ]);
        }

        return $user;
    }
}