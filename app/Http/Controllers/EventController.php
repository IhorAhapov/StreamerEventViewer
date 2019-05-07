<?php

namespace App\Http\Controllers;

use App\Common\TwitchAPIService;
use App\Events\Exceptions\InvalidEventType;
use App\Events\Services\EventServiceInterface;
use App\Models\Streamer;
use Illuminate\Http\Request;

class EventController extends Controller
{

    /**
     * @var EventServiceInterface
     */
    private $eventService;

    /**
     * EventController constructor.
     * @param EventServiceInterface $eventService
     */
    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    public function accept(Streamer $streamer, Request $request)
    {
        info("ACCEPT action. Channel id = {$streamer->id} : " . json_encode($request->all()));//todo remove it

        if ($request->has('hub_challenge')) {
            return $request->get('hub_challenge');
        }

        return abort(400);
    }

    public function store(Streamer $streamer, string $type, Request $request)
    {
        info("STORE action. Channel id = {$streamer->id} : " . json_encode($request->all()));//todo remove it

        if (!in_array($type, TwitchAPIService::EVENT_TYPES)) {
            throw new InvalidEventType();
        }

        $this->eventService->store($request->all(), $type, $streamer);
    }
}
