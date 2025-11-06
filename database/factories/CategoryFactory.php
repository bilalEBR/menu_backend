<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Required for slug generation

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    // The model this factory generates data for
    protected $model = Category::class;

    /**
     * Define the model's default state (i.e., the fake data structure).
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 1. Generate a name and ensure it's unique
        $name = $this->faker->unique()->name();
       


        $hotelIds = Hotel::pluck('id')->toArray();

        // Safety check and random selection
        $randomHotelId = !empty($hotelIds) ? $this->faker->randomElement($hotelIds) : 1;
        return [
            // Matches the 'name' column in the migration
            'category_name' => $name, 
    // This tells the factory to automatically create a new Hotel record 
            // and use its ID, unless a specific hotel_id is passed during factory creation.
            'hotel_id' => $randomHotelId,
        ];
    }
}
