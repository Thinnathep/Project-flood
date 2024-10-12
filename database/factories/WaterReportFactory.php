<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaterReport>
 */
class WaterReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location' => $this->faker->city,
            'water_source_type' => $this->faker->randomElement(['river', 'flood_area']),
            'water_source_name' => $this->faker->word,
            'water_level' => $this->faker->randomFloat(2, 0, 10),
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['normal', 'warning', 'danger']),
        ];
    }
}
