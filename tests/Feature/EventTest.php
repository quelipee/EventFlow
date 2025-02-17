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
        $user = User::factory()->create(['id' => 27]);
        Event::factory()->create([
            'eventStart' => Carbon::create(2025,2,25,15,20),
            'eventEnd' => Carbon::create(2025,2,25,16,00),
            'user_id' => $user->id,
        ]);
        $payload = [
            'description' => 'Reunião semanal de equipe',
            'eventStart' => Carbon::create(2025,2,25,13,20),
            'eventEnd' => Carbon::create(2025,2,25,15,19),
        ];
        Sanctum::actingAs($user);
        $response = $this->post('api/event/create', $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_user_can_update_event()
    {
        $user = User::factory()->create(['id' => 27]);
        $event = Event::factory()->create([
            'eventStart' => Carbon::create(2025,2,25,15,20),
            'eventEnd' => Carbon::create(2025,2,26,16,00),
            'user_id' => $user->id,
        ])->id;

        $payload = [
            'description' => 'Reunião de planejamento estratégico',
            'eventStart' => Carbon::create(2025, 3, 10, 14, 30),
            'eventEnd' => Carbon::create(2025, 3, 10, 16, 00),
        ];

        Sanctum::actingAs($user);
        $response = $this->put('api/event/edit/' . $event, $payload);
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $this->assertDatabaseHas('events', [
            'description' => $payload['description'],
        ]);
    }

    public function test_user_can_delete_event()
    {
        $user = User::factory()->create(['id' => 27]);
        $eventId = Event::factory()->create([
            'eventStart' => Carbon::create(2025,2,25,15,20),
            'eventEnd' => Carbon::create(2025,2,26,16,00),
            'user_id' => $user->id,
        ])->id;
        Sanctum::actingAs($user);
        $response = $this->delete('api/event/delete/' . $eventId);
        $response->assertStatus(ResponseAlias::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('events', [
            'id' => $eventId,
        ]);
    }

    public function test_user_can_list_events()
    {
        $user = User::factory()->create(['id' => 27]);
        Event::factory(10)->create([
            'user_id' => $user->id,
        ]);
        Sanctum::actingAs($user);
        $response = $this->get('api/event');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
}
