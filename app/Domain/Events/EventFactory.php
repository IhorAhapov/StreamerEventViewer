<?php

namespace App\Domain\Events;


use App\Domain\Events\Exceptions\InvalidEventFormat;
use App\Models\Event;

class EventFactory
{

    const EVENT_MAPPING = [
        'StreamMonitor' => [
            'name' => 'Stream status changed',
            'description' => '%s streaming "%s"',
            'emptyDataDescription' => 'Gone offline',
            'fields' => ['user_name', 'title']
        ],
        'UserFollows' => [
            'name' => 'Start following',
            'description' => '%s now follows %s',
            'emptyDataDescription' => '',
            'fields' => ['from_name', 'to_name']
        ],
        'UserGainsFollower' => [
            'name' => 'Gains follower',
            'description' => '%s gains new follower. Hi\'s name is %s',
            'emptyDataDescription' => '',
            'fields' => ['to_name', 'from_name']
        ]
    ];

    public static function makeFromArray(array $data, string $type): Event
    {
        $event = new Event();

        try {
            $fields = array_map(function($field) use ($data) {
                return $data[$field];
            }, self::EVENT_MAPPING[$type]['fields']);

            $event->description = vsprintf(self::EVENT_MAPPING[$type]['description'], $fields);
            $event->name = self::EVENT_MAPPING[$type]['name'];
        } catch (\Exception $exception) {
            throw new InvalidEventFormat();
        }


        return $event;
    }
}