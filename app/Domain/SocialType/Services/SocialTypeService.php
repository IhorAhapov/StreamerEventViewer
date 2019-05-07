<?php

namespace App\Domain\SocialType\Services;


use App\Models\SocialType;
use App\Domain\SocialType\Repositories\SocialTypeRepositoryInterface;

class SocialTypeService implements SocialTypeServiceInterface
{

    /**
     * @var SocialTypeRepositoryInterface
     */
    private $socialTypeRepository;

    /**
     * SocialTypeService constructor.
     * @param SocialTypeRepositoryInterface $socialTypeRepository
     */
    public function __construct(SocialTypeRepositoryInterface $socialTypeRepository)
    {
        $this->socialTypeRepository = $socialTypeRepository;
    }

    public function getAll(): array
    {
        return $this->socialTypeRepository->getAll();
    }

    public function findByName(string $name): SocialType
    {
        return $this->socialTypeRepository->findByName($name);
    }
}