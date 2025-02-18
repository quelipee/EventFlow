<?php

namespace App\EventDomain\exceptions;

class EventException extends \Exception
{
    public static function EventTimeConflictException(): EventException
    {
        return new self("Já existe um evento com esta data ou horario");
    }

    public static function EventNotFoundException(): EventException
    {
        return new self("Evento não encontrado");
    }

    public static function UnauthorizedEventEditException(object|string|null $eventId): EventException
    {
        return new self("Evento não autorizado id: {$eventId}");
    }
}
