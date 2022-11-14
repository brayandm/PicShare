<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $exampleUser = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Person::factory(10)->create();

        $examplePerson = \App\Models\Person::factory()->create([
            'user_id' => $exampleUser,
        ]);

        \App\Models\Post::factory(10)->create();

        \App\Models\Post::factory(3)->create([
            'person_id' => $examplePerson,
        ]);
    }
}
