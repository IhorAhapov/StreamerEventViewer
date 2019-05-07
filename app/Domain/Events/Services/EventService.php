<?php

namespace App\Domain\Events\Services;


use App\Domain\Events\EventFactory;
use App\Domain\Events\Exceptions\InvalidEventFormat;
use App\Domain\Events\Repositories\EventRepositoryInterface;
use App\Models\Streamer;

class EventService implements EventServiceInterface
{

    const SHOW_LAST_EVENTS_COUNT = 10;

    /**
     * @var EventRepositoryInterface
     */
    private $eventRepository;

    /**
     * EventService constructor.
     * @param EventRepositoryInterface $eventRepository
     */
    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function store(array $event, string $type, Streamer $streamer): bool
    {
        try {
            $event = EventFactory::makeFromArray(array_shift($event['data']), $type);
        } catch (InvalidEventFormat $exception) {
            // todo some exception handle here
            info($exception->getMessage());
        }

        return $this->eventRepository->create($event, $streamer);
    }

    public function getByStreamer(Streamer $streamer): array
    {
        return $this->eventRepository->getByStreamer($streamer, self::SHOW_LAST_EVENTS_COUNT);
    }
}