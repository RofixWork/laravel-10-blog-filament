<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = fake()->realText(50);
        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "body" => $this->faker->realText(5000),
            "thumbnail" => $this->faker->imageUrl(),
            "active" => $this->faker->boolean,
            "published_at" => $this->faker->dateTime,
            "user_id" => 1
        ];
    }
}
