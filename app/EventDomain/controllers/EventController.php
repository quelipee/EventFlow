<?php

namespace App\EventDomain\controllers;

use App\EventDomain\contracts\EventContract;
use App\EventDomain\dto\eventDTO;
use App\EventDomain\requests\EventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EventController extends Controller
{
    public function __construct(
        protected EventContract $contract,
    ){}

    public function createEvent(eventRequest $request): JsonResponse
    {
        $event_created = $this->contract->addEvent(eventDTO::fromValidatedData($request));
        return response()->json([
            'message' => 'Event created.',
            'data' => $event_created,
        ], ResponseAlias::HTTP_CREATED);
    }

    public function updateEvent(eventRequest $request, int $eventId): JsonResponse
    {
        $event_updated =
            $this->contract->modifyEvent(eventDTO::fromValidatedData($request), $eventId);
        return response()->json([
            'message' => 'Event updated.',
            'data' => $event_updated,
        ],ResponseAlias::HTTP_OK);
    }

    public function deleteEvent(int $eventId): JsonResponse
    {
        $this->contract->destroyEvent($eventId);
        return response()->json([
            'message' => 'Event deleted.',
            'data' => null,
        ], ResponseAlias::HTTP_NO_CONTENT);
    }

    public function listEvents(): JsonResponse
    {
        $all_event = $this->contract->allEvent();
        return response()->json([
            'message' => 'Event list.',
            'data' => $all_event,
        ],ResponseAlias::HTTP_OK);
    }
}
