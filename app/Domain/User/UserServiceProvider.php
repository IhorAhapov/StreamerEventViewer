<?php

namespace App\Domain\User;


use App\Domain\SocialType\Services\SocialTypeServiceInterface;
use App\Domain\User\Repositories\UserRepository;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\Services\UserService;
use App\Domain\User\Services\UserServiceInterface;
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