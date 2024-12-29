<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::inRandomOrder()->first()->id,
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'content' => fake()->paragraphs(3, true),
            'image' => fake()->imageUrl(640, 480, 'blogs'),
            'status' => 'approved',
            'views' => fake()->numberBetween(0, 500),
            'likes' => fake()->numberBetween(0, 100),
        ];
    }
}
