<?php

namespace App\Http\Middleware;

use App\EventDomain\exceptions\EventException;
use App\Models\Event;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventEventOverlap
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws EventException
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
         * ESTA FUNCAO VERIFICA ANTES DE CRIAR UM EVENTO, SE ESTA DISPONIVEL O HORARIO, PARA NAO TER CONFLITO
         * */
        $eventId = $request->route('id');

        $event_exist = Event::whereHas('user', function (Builder $query) use ($eventId, $request) {
            $query->where('user_id', Auth::id())
            ->where('event_id', $eventId)
            ->whereBetween('eventStart', [ $request->eventStart, $request->eventEnd ])
            ->orWhereBetween('eventEnd', [ $request->eventStart, $request->eventEnd ]);
        })
        ->where(function (Builder $query) use ($eventId) {
            if ($eventId) {
                $query->where('id', '<>' ,$eventId);
            }
        })->exists();

        if ($event_exist) {
            throw EventException::EventTimeConflictException();
        }
        return $next($request);
    }
}
