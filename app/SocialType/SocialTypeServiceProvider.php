<?php

namespace App\SocialType;

use App\SocialType\Repositories\SocialTypeRepository;
use App\SocialType\Repositories\SocialTypeRepositoryInterface;
use App\SocialType\Services\SocialTypeService;
use App\SocialType\Services\SocialTypeServiceInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class SocialTypeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SocialTypeServiceInterface::class, function(Container $app) {
            return new SocialTypeService(
                $app->make(SocialTypeRepositoryInterface::class)
            );
        });

        $this->app->bind(SocialTypeRepositoryInterface::class, function() {
            return new SocialTypeRepository();
        });
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