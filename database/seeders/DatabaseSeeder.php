<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // UserRequest::factory(10)->create();

        User::factory()->create([
            'name' => 'Test UserRequest',
            'email' => 'test@example.com',
        ]);
    }
}
