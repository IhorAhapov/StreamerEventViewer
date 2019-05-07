<?php

namespace App\Http\Controllers;

use App\Domain\Events\Services\EventServiceInterface;
use App\Domain\Streamer\Services\StreamerServiceInterface;
use App\Models\Streamer;
use App\Http\Requests\AddToFavoriteRequest;

class StreamerController extends Controller
{

    /**
     * @var StreamerServiceInterface
     */
    private $streamerService;
    /**
     * @var EventServiceInterface
     */
    private $eventService;

    /**
     * StreamerController constructor.
     * @param StreamerServiceInterface $streamerService
     * @param EventServiceInterface $eventService
     */
    public function __construct(StreamerServiceInterface $streamerService, EventServiceInterface $eventService)
    {
        $this->streamerService = $streamerService;
        $this->eventService = $eventService;
    }

    public function index()
    {
        $streamers = $this->streamerService->getAllStreamers();
        return view('dashboard', ['streamers' => $streamers]);
    }

    public function addToFavorite(AddToFavoriteRequest $request)
    {
        $this->streamerService->saveToFavorite($request->get('name'));
        return redirect(route('dashboard'));
    }

    public function delete(Streamer $streamer)
    {
        $this->streamerService->delete($streamer);
        return back();
    }

    public function show(Streamer $streamer)
    {
        return view('streamer', [
            'streamer' => $streamer,
            'events' => $this->eventService->getByStreamer($streamer)
        ]);
    }

}