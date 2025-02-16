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
}
