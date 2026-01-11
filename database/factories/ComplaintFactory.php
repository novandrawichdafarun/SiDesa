<?php

namespace Database\Factories;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resident_id' => Resident::factory(),
            'title' => fake()->sentence(4),
            'content' => fake()->paragraph(),
            'status' => fake()->randomElement(['new', 'processing', 'completed']),
            'photo_proof' => null,
            'report_date' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
