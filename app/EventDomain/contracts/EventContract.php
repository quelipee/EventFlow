<?php

namespace App\EventDomain\contracts;

use App\EventDomain\dto\eventDTO;
use App\Models\Event;

interface EventContract
{
    public function addEvent(eventDTO $eventDTO) : Event;
    public function modifyEvent(eventDTO $eventDTO, int $eventId) : Event;
    public function destroyEvent(int $eventId): bool;
}
