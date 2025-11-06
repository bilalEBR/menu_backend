<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get all category IDs and choose a random one
        $categoryIds = Category::pluck('id')->toArray();
        $categoryId = !empty($categoryIds) ? $this->faker->randomElement($categoryIds) : 1;
        
        // Get all hotel IDs and choose a random one
        $hotelIds = Hotel::pluck('id')->toArray();
        $randomHotelId = !empty($hotelIds) ? $this->faker->randomElement($hotelIds) : 1;

        return [
            // Ensure every menu item is associated with a Hotel.
            // If a Hotel is not explicitly provided when running the factory,
            // this will automatically create a new one.
            'hotel_id' => $randomHotelId,
            'category_id' => $categoryId,
            // Generate a simple, descriptive name (e.g., 'Spicy Tofu Stir-Fry')
            'item_name' => $this->faker->unique()->words(2, true), 

            // A short description of the item
            'description' => $this->faker->sentence(),

            // A price between 5.00 and 35.00 with two decimal places
            'price' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}