<?php

namespace App\Domain\Streamer;


use App\Domain\Streamer\Repositories\StreamerRepository;
use App\Domain\Streamer\Repositories\StreamerRepositoryInterface;
use App\Domain\Streamer\Services\StreamerService;
use App\Domain\Streamer\Services\StreamerServiceInterface;
use App\Domain\Common\TwitchAPIService;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class StreamerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StreamerServiceInterface::class, function(Container $app) {
            return new StreamerService(
                $app->make(StreamerRepositoryInterface::class),
                $app->make(TwitchAPIService::class)
            );
        });

        $this->app->bind(StreamerRepositoryInterface::class, function() {
            return new StreamerRepository();
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