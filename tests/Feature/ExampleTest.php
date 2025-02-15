<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $payload = [
            'name' => 'felipe mateus',
            'email' => 'felipe.mateus@gmail.com',
            'password' => '123456',
            'passwordRepeat' => '123456',
        ];
        $response = $this->post('api/signUp', $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_user_can_login()
    {

    }
}
