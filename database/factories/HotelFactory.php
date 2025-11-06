<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => $this->faker->company(), // Automatically generates a fake company name
        'address' => $this->faker->address(),
        'phone' => $this->faker->phoneNumber(),
        'image' => fake()->imageUrl(width: 1280, height: 720, category: 'any', randomize: true),
        ];
    }
}
