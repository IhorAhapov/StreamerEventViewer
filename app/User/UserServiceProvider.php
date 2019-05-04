<?php

namespace App\User;

use App\SocialType\Services\SocialTypeServiceInterface;
use App\User\Repositories\UserRepository;
use App\User\Repositories\UserRepositoryInterface;
use App\User\Services\UserService;
use App\User\Services\UserServiceInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, function(Container $app) {
            return new UserService(
                $app->make(UserRepositoryInterface::class),
                $app->make(SocialTypeServiceInterface::class)
            );
        });

        $this->app->bind(UserRepositoryInterface::class, function() {
            return new UserRepository();
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