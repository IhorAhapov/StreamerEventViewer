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

    const EVENT_TYPES = [
        'StreamMonitor',
        'UserFollows',
        'UserGainsFollower'
    ];

    const SUBSCRIBE_WEBHOOK_ACTION = 'subscribeWebhook';
    const UNSUBSCRIBE_WEBHOOK_ACTION = 'unsubscribeWebhook';

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

        $streamerArray = json_decode(json_encode(array_shift($response->data)), true);

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
        $this->webhookAction($streamer, self::SUBSCRIBE_WEBHOOK_ACTION);
    }

    public function unsubscribeFromEvents(Streamer $streamer)
    {
        $this->webhookAction($streamer, self::UNSUBSCRIBE_WEBHOOK_ACTION);
    }

    private function webhookAction(Streamer $streamer, string $action) {
        try {
            foreach (self::EVENT_TYPES as $type) {
                $topic = 'webhookTopic' . $type;
                $this->twitch->{$action}(
                    route('twitchEventCallbackHandle', ['id' => $streamer->streamer_id, 'type' => $type]),
                    $this->twitch->{$topic}($streamer->streamer_id),
                    self::EVENT_LEASE_SECONDS
                );
            }
        } catch (\Exception $exception) {
            // todo some exception handle here
            info($exception->getMessage());
        }
    }

}