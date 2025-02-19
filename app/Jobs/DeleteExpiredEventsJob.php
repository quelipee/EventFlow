<?php

namespace App\Jobs;

use App\Console\Commands\DeleteExpiredEvents;
use App\EventDomain\TypeStatus;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class DeleteExpiredEventsJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $eventExpired = Event::query()
            ->where('eventEnd', '<', Carbon::now())
            ->where('status','<>','INATIVO')->get();
        foreach ($eventExpired as $e) {
            $event = Event::query()->find($e->id);
            $event->fill([
                'status' => TypeStatus::INACTIVE->value
            ]);
            $event->save();
        }
    }
}
