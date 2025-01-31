<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Land>
 */
class LandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'location' => 'Adeliaburgh', //,$this->faker->city,
            'price' => $this->faker->randomFloat(2, 100000, 1000000),
            'description' => $this->faker->paragraph,
            'is_active' => $this->faker->boolean,
            'image_url' => $this->faker->imageUrl()
        ];
    }
}
