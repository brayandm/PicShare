<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'person_id' => \App\Models\Person::factory()->create(),
            'header' => fake()->text(50),
            'text' => fake()->text(200),
            'likes' => fake()->randomNumber(2),
        ];
    }
}