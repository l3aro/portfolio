<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(fake()->numberBetween(4, 7)),
            'description' => fake()->sentences(fake()->numberBetween(4, 7), true),
            'content' => fake()->text(fake()->numberBetween(400, 700)),
            'published_at' => fake()->dateTimeBetween(),
        ];
    }
}
