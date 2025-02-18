<?php

namespace App\EventDomain\dto;

use App\EventDomain\requests\EventRequest;
use Carbon\Carbon;

readonly class eventDTO
{
    public Carbon $eventStart;
    public Carbon $eventEnd;
    public function __construct(
        public string $title,
        public string $description,
        string $eventStart,
        string $eventEnd,
    ){
        $this->eventStart = Carbon::parse($eventStart);
        $this->eventEnd = Carbon::parse($eventEnd);
    }

    public static function fromValidatedData(EventRequest $request): EventDTO
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            eventStart: $request->validated('eventStart'),
            eventEnd: $request->validated('eventEnd'),
        );
    }
}
