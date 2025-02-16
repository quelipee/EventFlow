<?php

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class EventTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_create_event() {
        $payload = [
            'description' => 'Reunião semanal de equipe',
            'eventStart' => Carbon::create(2025,2,25,15,20),
            'eventEnd' => Carbon::create(2025,2,26,16,00),
        ];
        Sanctum::actingAs(User::factory()->create());
        $response = $this->post('api/event/create', $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_user_can_update_event()
    {
        $event = Event::factory()->create([
            'eventStart' => Carbon::create(2025,2,25,15,20),
            'eventEnd' => Carbon::create(2025,2,26,16,00),
        ])->id;

        $payload = [
            'description' => 'Reunião de planejamento estratégico',
            'eventStart' => Carbon::create(2025, 3, 10, 14, 30),
            'eventEnd' => Carbon::create(2025, 3, 10, 16, 00),
        ];

        Sanctum::actingAs(User::factory()->create());
        $response = $this->put('api/event/edit/' . $event, $payload);
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $this->assertDatabaseHas('event', [
            'description' => $payload['description'],
        ]);
    }

    public function test_user_can_delete_event()
    {
        $eventId = Event::factory()->create([
            'eventStart' => Carbon::create(2025,2,25,15,20),
            'eventEnd' => Carbon::create(2025,2,26,16,00),
        ])->id;
        Sanctum::actingAs(User::factory()->create());
        $response = $this->delete('api/event/delete/' . $eventId);
        $response->assertStatus(ResponseAlias::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('event', [
            'id' => $eventId,
        ]);
    }
}
