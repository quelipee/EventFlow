<?php

namespace App\EventDomain\services;

use App\EventDomain\contracts\EventContract;
use App\EventDomain\dto\eventDTO;
use App\EventDomain\exceptions\EventException;
use App\Jobs\DeleteExpiredEventsJob;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EventService implements EventContract
{
    public function addEvent(eventDTO $eventDTO) : Event
    {
        $event_new =  new Event([
            'title' => $eventDTO->title,
            'description' => $eventDTO->description,
            'eventStart' => $eventDTO->eventStart,
            'eventEnd' => $eventDTO->eventEnd,
        ]);
        $event_new->user()->associate(Auth::user());
        $event_new->save();

        return $event_new;
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

    public function allEvent(): Collection
    {
        return Event::query()->where('user_id', Auth::id())->get();
    }
}
