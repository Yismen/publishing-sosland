<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'date' => now(),
            'email' => $this->faker->email,
            'campaign' => $this->faker->name,
            'disposition' => $this->faker->name,
            'email_sent_at' => null,
        ];
    }
}
