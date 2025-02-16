<?php

namespace App\EventDomain\services;

use App\EventDomain\contracts\EventContract;
use App\EventDomain\dto\eventDTO;
use App\EventDomain\exceptions\EventException;
use App\Models\Event;
use Carbon\Carbon;

class EventService implements EventContract
{
    /**
     * @throws EventException
     */
    public function addEvent(eventDTO $eventDTO) : Event
    {
        $this->isEventTimeConflict($eventDTO->eventStart);

        return Event::create([
            'description' => $eventDTO->description,
            'eventStart' => $eventDTO->eventStart,
            'eventEnd' => $eventDTO->eventEnd,
        ]);
    }

    /**
     * @throws EventException
     */
    private function isEventTimeConflict (Carbon $eventStart): void
    {
        //TODO PENSANDO MELHOR COMO VAI FUNCIONAR SE VAI TER UM TEMPO DE DIFERENÇA ENTRA OS EVENTOS
        $event_exist = Event::query()->where(['eventStart' => $eventStart])->exists();
        if ($event_exist) {
            throw EventException::EventTimeConflictException();
        }
    }

    /**
     * @throws EventException
     */
    public function modifyEvent(eventDTO $eventDTO, int $eventId): Event
    {
        $this->eventNotFound($eventId);
        $event = Event::query()->findOrFail($eventId);
        $event->fill((array)($eventDTO));
        $event->save();

        return $event;
    }

    /**
     * @throws EventException
     */
    private function eventNotFound(int $eventId): void
    {
        $exist = Event::query()->where(['id' => $eventId])->exists();
        if (!$exist) {
            throw EventException::EventNotFoundException();
        }
    }

    public function destroyEvent(int $eventId): bool
    {
        $event = Event::query()->findOrFail($eventId);
        return $event->delete();
    }
}
