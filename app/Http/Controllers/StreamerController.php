<?php

namespace App\Http\Controllers;

use App\Streamer\Services\StreamerServiceInterface;
use App\Http\Requests\AddToFavoriteRequest;

class StreamerController extends Controller
{

    /**
     * @var StreamerServiceInterface
     */
    private $streamerService;

    /**
     * StreamerController constructor.
     * @param StreamerServiceInterface $streamerService
     */
    public function __construct(StreamerServiceInterface $streamerService)
    {
        $this->streamerService = $streamerService;
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

    public function show(int $id)
    {
        return view('streamer', ['streamer' => $this->streamerService->getById($id)]);
    }

}