<?php

namespace App\Common;


use App\Streamer\StreamerFactory;
use App\Streamer\Exceptions\StreamerNotFound;
use App\Streamer\Exceptions\InvalidStreamerArray;
use App\Models\Streamer;
use \romanzipp\Twitch\Twitch;

class TwitchAPIService
{

    const EVENT_LEASE_SECONDS = 864000;
    /**
     * @var Twitch
     */
    private $twitch;

    /**
     * TwitchAPIService constructor.
     * @param Twitch $twitch
     */
    public function __construct(Twitch $twitch)
    {
        $this->twitch = $twitch;
    }

    public function getStreamerByName(string $name) : Streamer
    {
        try {
            $response = $this->twitch->getUserByName($name);
        } catch (\Exception $exception) {
            // todo some exception handle here
            info($exception->getMessage());
            throw new StreamerNotFound();
        }

        $streamerArray = json_decode(json_encode(collect($response->data)->first()), true);

        if (!$streamerArray) {
            throw new StreamerNotFound();
        }

        try {
            return StreamerFactory::makeFromArray($streamerArray);
        } catch (InvalidStreamerArray $exception) {
            // todo some exception handle here
            info($exception->getMessage());
            throw new StreamerNotFound();
        }
    }

    public function subscribeToEvents(Streamer $streamer)
    {
        try {
            $this->twitch->subscribeWebhook(
                route('twitchEventsCallbackConfirm', ['id' => $streamer->streamer_id]),
                $this->twitch->webhookTopicStreamMonitor($streamer->streamer_id),
                self::EVENT_LEASE_SECONDS
            );

            $this->twitch->subscribeWebhook(
                route('twitchEventsCallbackConfirm', ['id' => $streamer->streamer_id]),
                $this->twitch->webhookTopicUserFollows($streamer->streamer_id),
                self::EVENT_LEASE_SECONDS
            );

            $this->twitch->subscribeWebhook(
                route('twitchEventsCallbackConfirm', ['id' => $streamer->streamer_id]),
                $this->twitch->webhookTopicUserGainsFollower($streamer->streamer_id),
                self::EVENT_LEASE_SECONDS
            );
        } catch (\Exception $exception) {
            // todo some exception handle here
            info($exception->getMessage());
        }

    }

    public function unsubscribeFromEvents(Streamer $streamer)
    {
        //todo unsubscribe when streamer was deleted
    }
}