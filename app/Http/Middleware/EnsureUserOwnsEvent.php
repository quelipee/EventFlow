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
        $user_eventID = Event::find($eventId);
        $user_exist = Auth::user()->events()->where('user_id', $user_eventID->user_id)->exists();
        if (!$user_exist) {
            throw EventException::UnauthorizedEventEditException($eventId);
        }

        return $next($request);
    }
}
