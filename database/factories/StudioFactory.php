<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Studio>
 */
class StudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, 
            'avatar' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph(),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            //updated_at after created_at
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
