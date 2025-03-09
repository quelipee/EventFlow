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

        $payload = [
            'title' => 'Alinhamento',
            'description' => 'Reunião semanal de equipe',
            'eventStart' => Carbon::create(2025,3,25,13,20),
            'eventEnd' => Carbon::create(2025,3,25,15,19),
        ];
        Sanctum::actingAs($user);
        $response = $this->post('api/event', $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_user_can_update_event()
    {
        $this->test_user_can_create_event();
        $user = User::find(27);
        $event = Event::first();

        $payload = [
            'title' => 'Alinhamento de tudo',
            'description' => 'Reunião de planejamento estratégico',
            'eventStart' => Carbon::create(2025, 3, 10, 14, 30),
            'eventEnd' => Carbon::create(2025, 3, 10, 16, 00),
        ];

        Sanctum::actingAs($user);
        $response = $this->put('api/event/' . $event->id, $payload);
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
        ])->id;
        Sanctum::actingAs($user);
        $response = $this->delete('api/event/' . $eventId);
        $response->assertStatus(ResponseAlias::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('events', [
            'id' => $eventId,
        ]);
    }

    public function test_user_can_list_events()
    {
        $user = User::factory()->create(['id' => 27]);
        $events = Event::factory(10)->create();

        foreach ($events as $event)
        {
            $user->events()->attach($event->id);
        }

        Sanctum::actingAs($user);
        $response = $this->get('api/event');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_user_can_invite()
    {
        $user = User::factory()->create(['id' => 27]);
        $user1 = User::factory()->create(['id' => 28]);
        $event_id = Event::factory()->create()->id;

        $user->events()->attach($event_id);
        Sanctum::actingAs($user);

        $response = $this->post("api/{$event_id}/invite", ['inviteId' => $user1->id]);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }
    public function test_user_can_join_event()
    {
        $this->test_user_can_invite();
        $eventId = Event::first()->id;
        $user = User::find(28);
        Sanctum::actingAs($user);

        $response = $this->post("api/{$eventId}/join", ['statusResponse' => true]);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
}
