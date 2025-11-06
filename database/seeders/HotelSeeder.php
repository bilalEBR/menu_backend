<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds to create our primary Hotel records.
     */
    public function run(): void
    {
        // 1. Clear existing hotel records to prevent duplication
        // This is good practice for seeders that define fixed data.
        Hotel::truncate(); 

        // 2. Insert the main Hotel records manually (without using a factory)
        // Hotel::create([
        //     'name' => 'Golden Palm Resort',
        //     'address' => '123 Ocean Drive, Coastal City',
        //     'phone' => '0965432267',
        // ]);

        // // Add more hotels if you wish, for better testing:
        // Hotel::create([
        //     'name' => 'Downtown Diner',
        //     'address' => '45 Main Street, Capital City',
        //     'phone' => '0912345678',
        // ]);
        
        // Hotel::create([
        //     'name' => 'The Cozy Corner',
        //     'address' => '789 Mountain View Rd, Hillside',
        //     'phone' => '0987654321',
        // ]);

         Hotel::factory(5)->create();
    }
}
