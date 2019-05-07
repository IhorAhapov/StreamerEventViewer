<?php

namespace App\Domain\Events;


use App\Domain\Events\Repositories\EventRepository;
use App\Domain\Events\Repositories\EventRepositoryInterface;
use App\Domain\Events\Services\EventService;
use App\Domain\Events\Services\EventServiceInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventServiceInterface::class, function(Container $app) {
            return new EventService(
                $app->make(EventRepositoryInterface::class)
            );
        });

        $this->app->bind(EventRepositoryInterface::class, function() {
            return new EventRepository();
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