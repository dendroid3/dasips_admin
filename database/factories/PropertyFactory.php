<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::orderedUuid() -> toString(),
            'title' => $this->faker->word,
            'property_type' => $this->faker->randomElement(['house', 'apartment', 'condo']),
            'location' => 'Adeliaburgh', //,$this->faker->city,
            'price' => $this->faker->randomFloat(2, 100000, 1000000),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'description' => $this->faker->paragraph,
            'is_active' => $this->faker->boolean,
            'image_url' => $this->faker->imageUrl()
        ];
    }
}
