<?php

namespace App\EventDomain\exceptions;

class EventException extends \Exception
{
    public static function EventTimeConflictException(): EventException
    {
        return new self("Event Time Conflict");
    }

    public static function EventNotFoundException(): EventException
    {
        return new self("Event Not Found");
    }

    public static function UnauthorizedEventEditException(object|string|null $eventId): EventException
    {
        return new self("Unauthorized event id: {$eventId}");
    }
}
