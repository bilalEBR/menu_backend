<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Use the built-in Laravel method to disable constraints. 
        // This is database-agnostic and works for Postgres.
        Schema::withoutForeignKeyConstraints(function () {
            
            // 1. Truncate users first (if restarting the seeder)
            User::truncate(); 

            // 2. Call other Seeders
            $this->call([
                HotelSeeder::class, 
                CategorySeeder::class,
                MenuitemSeeder::class
            ]);

            // 3. Create specific users
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'), // Use a standard default
                'role' => 'public',
            ]);
            
            User::factory()->create([
                'name' => 'bilal',
                'email' => 'bilal@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'admin',
            ]);

            User::factory()->create([
                'name' => 'bila',
                'email' => 'bila@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'public',
            ]);

            // 4. Bulk Creation (10 general users)
            User::factory(10)->create();
        });
    }
}