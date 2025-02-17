<?php

namespace App\Http\Middleware;

use App\EventDomain\exceptions\EventException;
use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
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
        $event_exist = Event::query()->where(function ($query) use ($request) {
            $query->whereBetween('eventStart', [$request->eventStart, $request->eventEnd])
                ->orWhereBetween('eventEnd', [$request->eventStart, $request->eventEnd]);
        })->exists();
        if ($event_exist) {
            throw EventException::EventTimeConflictException();
        }
        return $next($request);
    }
}
