<?php

namespace Database\Factories;

use App\Models\LetterType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LetterRequest>
 */
class LetterRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'letter_type_id' => LetterType::inRandomOrder()->first()->id ?? 1,
            'purpose' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'disetujui_rt_rw', 'disetujui_admin', 'rejected', 'selesai']),
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
