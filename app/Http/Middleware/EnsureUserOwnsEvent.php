<?php

namespace App\Http\Middleware;

use App\EventDomain\exceptions\EventException;
use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserOwnsEvent
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws EventException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $eventId = $request->route()->parameter('id');
        $eventUserFind = Auth::user()->events()->where('event_id', $eventId)->exists();

        if (!$eventUserFind) {
            throw EventException::UnauthorizedEventEditException($eventId);
        }

        return $next($request);
    }
}
