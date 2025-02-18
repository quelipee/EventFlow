<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventStart = Carbon::instance($this->faker->dateTimeBetween('now', '+1 year'));
        $eventEnd = Carbon::instance($this->faker->dateTimeBetween($eventStart->copy()->addMinutes(1), $eventStart->copy()->addDays(7)));

        return [
            'title' => $this->faker->title,
            'description' => $this->faker->realText(100),
            'eventStart' => $eventStart,
            'eventEnd' => $eventEnd,
        ];
    }
}
