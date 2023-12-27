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
    public function definition(): array
    {
        return [
            'title' => fake()->text(),
            'slug' => fake()->slug,
            'preview_text' => fake()->text(250),
            'text' => fake()->sentences(10, true),
            'user_id' => 1,
            'is_approved' => true,
        ];
    }
}