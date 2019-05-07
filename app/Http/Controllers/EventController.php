<?php

namespace App\Http\Controllers;

use App\Common\TwitchAPIService;
use App\Events\Exceptions\InvalidEventType;
use App\Events\Services\EventServiceInterface;
use App\Streamer\Services\StreamerServiceInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{

    /**
     * @var EventServiceInterface
     */
    private $eventService;
    /**
     * @var StreamerServiceInterface
     */
    private $streamerService;

    /**
     * EventController constructor.
     * @param EventServiceInterface $eventService
     * @param StreamerServiceInterface $streamerService
     */
    public function __construct(EventServiceInterface $eventService, StreamerServiceInterface $streamerService)
    {
        $this->eventService = $eventService;
        $this->streamerService = $streamerService;
    }

    public function accept(int $id, Request $request)
    {
        if ($request->has('hub_challenge')) {
            return $request->get('hub_challenge');
        }

        return abort(400);
    }

    public function store(int $id, string $type, Request $request)
    {
        $streamer = $this->streamerService->getByStreamerId($id);

        if (!in_array($type, TwitchAPIService::EVENT_TYPES)) {
            throw new InvalidEventType();
        }

        $this->eventService->store($request->all(), $type, $streamer);
    }
}
