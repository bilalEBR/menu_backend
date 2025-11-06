<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Seed the menu_items table, ensuring items are linked to existing hotels.
     */
    public function run(): void
    {
        // Safety: Truncate the table before seeding to prevent duplicates
        MenuItem::truncate();
          MenuItem::factory(50)->create();
        // 1. Get ALL currently existing hotel IDs
        // $hotelIds = Hotel::pluck('id');
        
        // // Check if hotels exist before seeding menu items
        // if ($hotelIds->isEmpty()) {
        //     echo "Warning: No hotels found. Please run HotelSeeder first.\n";
        //     return;
        // }

        // // 2. Use the MenuItemFactory to create 50 items
        // // We use the 'state' function to randomly assign a 'hotel_id'
        // // from our list of existing hotels.
        // MenuItem::factory(20)->state(function (array $attributes) use ($hotelIds) {
        //     return [
        //         'hotel_id' => $hotelIds->random(),
        //     ];
        // })->create();
        
        // echo "Successfully seeded 20 menu items linked to existing hotels.\n";
    }
}
