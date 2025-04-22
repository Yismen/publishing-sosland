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
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'date' => now(),
            'email' => $this->faker->email,
            'campaign' => 'milling',
            'disposition' => 'Complete',
            'email_sent_at' => null,
        ];
    }

    public function unNotified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_sent_at' => null,
            ];
        });
    }

    public function notified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_sent_at' => now(),
            ];
        });
    }
}
