<?php

namespace App\Common;


use App\Streamer\StreamerFactory;
use App\Streamer\Exceptions\StreamerNotFound;
use App\Streamer\Exceptions\InvalidStreamerArray;
use App\Models\Streamer;
use \romanzipp\Twitch\Twitch;

class TwitchAPIService
{

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
        $response = $this->twitch->getUserByName($name);
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
        $this->twitch->subscribeWebhook(
            'https://webhook.site/2f8aeac0-997e-4f9d-84e7-fe1aaebf4bc1', //todo use route('twitchEventsCallback', ['bla' => vla]) for saving event here
            $this->twitch->webhookTopicStreamMonitor($streamer->streamer_id),
            7200
        );

        $this->twitch->subscribeWebhook(
            'https://webhook.site/2f8aeac0-997e-4f9d-84e7-fe1aaebf4bc1',
            $this->twitch->webhookTopicUserFollows($streamer->streamer_id),
            7200
        );

        $this->twitch->subscribeWebhook(
            'https://webhook.site/2f8aeac0-997e-4f9d-84e7-fe1aaebf4bc1',
            $this->twitch->webhookTopicUserGainsFollower($streamer->streamer_id),
            7200
        );
    }
}