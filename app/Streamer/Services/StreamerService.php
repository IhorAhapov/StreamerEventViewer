<?php

namespace App\Streamer\Services;


use App\Streamer\Exceptions\StreamerNotFound;
use App\Streamer\Repositories\StreamerRepositoryInterface;
use App\Common\TwitchAPIService;
use App\Models\Streamer;
use Illuminate\Support\Facades\Auth;

class StreamerService implements StreamerServiceInterface
{

    /**
     * @var StreamerRepositoryInterface
     */
    private $streamerRepository;
    /**
     * @var TwitchAPIService
     */
    private $twitchAPIService;

    /**
     * StreamerService constructor.
     * @param StreamerRepositoryInterface $streamerRepository
     * @param TwitchAPIService $twitchAPIService
     */
    public function __construct(StreamerRepositoryInterface $streamerRepository, TwitchAPIService $twitchAPIService)
    {
        $this->twitchAPIService = $twitchAPIService;
        $this->streamerRepository = $streamerRepository;
    }

    public function saveToFavorite(string $name): bool
    {
        $this->streamerRepository->setUser(Auth::user());

        try {
            $streamer = $this->twitchAPIService->getStreamerByName($name);
        } catch (StreamerNotFound $exception) {
            return false;
        }

        $streamer = $this->streamerRepository->create($streamer);
        $this->twitchAPIService->subscribeToEvents($streamer);

        return true;
    }

    public function getAllStreamers(): array
    {
        $this->streamerRepository->setUser(Auth::user());
        return $this->streamerRepository->getAll();
    }

    public function getByStreamerId(int $id): Streamer
    {
        return $this->streamerRepository->getByStreamerId($id);
    }

    public function delete(Streamer $streamer): bool
    {
        $this->twitchAPIService->unsubscribeFromEvents($streamer);
        return $this->streamerRepository->delete($streamer);
    }
}