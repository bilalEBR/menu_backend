<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();

            // === CRITICAL FOREIGN KEY SETUP ===

            // 1. Foreign Key to the 'hotels' table (Parent relationship)
            $table->foreignId('hotel_id')
                  ->constrained() // Links to the 'hotels' table
                  ->onDelete('cascade'); // If a Hotel is deleted, its Menu Items are deleted.

            // 2. Foreign Key to the 'categories' table (Organization relationship)
            // Mentor Note: We use 'foreignId' and 'constrained' for clean, Eloquent-ready linking.
            $table->foreignId('category_id')
                  ->constrained() // Links to the 'categories' table
                  ->onDelete('cascade'); // If a Category is deleted, its Menu Items are deleted.

            // === END FOREIGN KEY SETUP ===

            $table->timestamps();
            
            // Add indexes for efficient lookups and querying
            $table->index(['hotel_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};