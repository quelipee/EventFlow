<?php

namespace App\EventDomain\dto;

use App\EventDomain\requests\EventRequest;
use Carbon\Carbon;

readonly class eventDTO
{
    public function __construct(
        public string $description,
        public Carbon $eventStart,
        public Carbon $eventEnd,
    ){}

    public static function fromValidatedData(EventRequest $request): EventDTO
    {
        return new self(
            description: $request->validated('description'),
            eventStart: $request->validated('eventStart'),
            eventEnd: $request->validated('eventEnd'),
        );
    }
}
