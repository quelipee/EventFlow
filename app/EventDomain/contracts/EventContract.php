<?php

namespace App\EventDomain\contracts;

use App\EventDomain\dto\eventDTO;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

interface EventContract
{
    public function addEvent(eventDTO $eventDTO) : Event;
    public function modifyEvent(eventDTO $eventDTO, int $eventId) : Event;
    public function destroyEvent(int $eventId): bool;
    public function allEvent() : Collection;
}
