<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence;
        $slug = Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000);

        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->text(2000),
            'thumbnail' => 'https://placehold.jp/300x200.png',
            'cover_image' => 'https://placehold.jp/800x400.png',
            'likes_count' => $this->faker->numberBetween(0, 100),
            'views_count' => $this->faker->numberBetween(0, 1000),
            'published_at' => $this->faker->dateTimeBetween('-1 years'),
        ];
    }
}
