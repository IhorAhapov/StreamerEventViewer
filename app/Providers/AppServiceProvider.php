<?php

namespace App\Providers;

use App\SocialType\SocialTypeRepository;
use App\SocialType\SocialTypeRepositoryInterface;
use App\SocialType\SocialTypeService;
use App\SocialType\SocialTypeServiceInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
