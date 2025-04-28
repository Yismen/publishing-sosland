<?php

namespace Database\Factories;

use App\Models\User;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FailedImportRow>
 */
class FailedImportRowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data' => $this->faker->text(),
            'import_id' => Import::create([
                'file_name' => 'file_name',
                'file_path' => 'file_path',
                'importer' => 'importer',
                'processed_rows' => 0,
                'total_rows' => 0,
                'successful_rows' => 0,
                'user_id' => User::factory()->create()->id,
            ])->id,
            'validation_error' => $this->faker->text(),
        ];
    }
}
