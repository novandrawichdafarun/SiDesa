<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);

        return [
            'user_id' => User::factory(),
            'nik' => fake()->unique()->numerify('350#############'),
            'name' => fake()->name(),
            'gender' => $gender,
            'birth_date' => fake()->date(),
            'birth_place' => fake()->city(),
            'address' => fake()->address(),
            'rt' => fake()->randomElement(['001', '002', '003', null]),
            'rw' => fake()->randomElement(['001', '002', '003', null]),
            'religion' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu', null]),
            'marital_status' => fake()->randomElement(['single', 'married', 'divorced', 'widowed']),
            'occupation' => fake()->jobTitle(),
            'phone' => fake()->numerify('+62#########'),
            'status' => fake()->randomElement(['active', 'moved', 'deceased']),
        ];
    }
}
