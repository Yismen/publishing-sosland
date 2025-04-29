<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailFail>
 */
class EmailFailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email_failed_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'failable_id' => rand(1, 100),
            'failable_type' => $this->faker->text(),
            'data' => $this->faker->paragraph(),
            'exception' => $this->faker->paragraph(),
        ];
    }
}
