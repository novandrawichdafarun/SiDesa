<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'user_id' => User::factory(), // admin user
            'title' => $title,
            'content' => fake()->paragraphs(3, true),
            'image' => null,
            'slug' => \Illuminate\Support\Str::slug($title),
            'category' => fake()->randomElement(['berita', 'pengumuman', 'kegiatan']),
            'is_pinned' => fake()->boolean(20), // 20%
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
