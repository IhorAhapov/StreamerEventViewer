<?php

namespace App\SocialType\Services;


use App\Models\SocialType;

interface SocialTypeServiceInterface
{
    public function getAll() : array;
    public function findByName(string $name) : SocialType;
}