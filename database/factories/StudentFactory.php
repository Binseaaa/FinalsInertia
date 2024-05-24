<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_num' => strtoupper(fake()->bothify('??#########??')),
            'name' => fake() -> name(),
            'email' => fake() ->email(),
            'department' => fake()->randomElement(['CAST', 'COE', 'CON', 'CABM-HM', 'CABM-B', 'CCJ']),
            'status' => fake() -> randomElement(['Cleared', 'Not Cleared']),
        ];
    }
}
