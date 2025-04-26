<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'banner_path' => $this->faker->imageUrl(),
            'website' => $this->faker->url(),
            'keywords_separator' => $this->faker->randomElement(['&', '|']),
            'keywords' => $this->faker->words(3, false),
        ];
    }
}
