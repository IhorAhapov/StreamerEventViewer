<?php

namespace App\Events;

use App\Streamer\Repositories\ChannelRepository;
use App\Streamer\Repositories\ChannelRepositoryInterface;
use App\Streamer\Services\ChannelService;
use App\Streamer\Services\ChannelServiceInterface;
use App\Common\TwitchAPIService;
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
        $this->app->bind(ChannelServiceInterface::class, function(Container $app) {
            return new ChannelService(
                $app->make(ChannelRepositoryInterface::class),
                $app->make(TwitchAPIService::class)
            );
        });

        $this->app->bind(ChannelRepositoryInterface::class, function() {
            return new ChannelRepository();
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