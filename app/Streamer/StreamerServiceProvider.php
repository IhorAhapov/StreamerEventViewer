<?php

namespace App\Streamer;

use App\Streamer\Repositories\StreamerRepository;
use App\Streamer\Repositories\StreamerRepositoryInterface;
use App\Streamer\Services\StreamerService;
use App\Streamer\Services\StreamerServiceInterface;
use App\Common\TwitchAPIService;
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