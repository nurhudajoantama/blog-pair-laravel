<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
    public function definition()
    {
        $title = $this->faker->unique()->sentence(3);
        $slug = Str::slug($title);
        $body = $this->faker->paragraph;
        $excerpt = Str::limit(strip_tags($body, 35));
        $user_id = 1;
        return compact('title', 'slug', 'excerpt', 'body', 'user_id');
    }
}
