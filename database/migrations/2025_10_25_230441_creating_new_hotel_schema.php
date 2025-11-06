<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations (creates the table).
     */
    public function up(): void
    {
        // FIX: Table name must be plural: 'hotels'
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Added length constraint
            $table->string('address', 255);
            $table->string('phone', 20)->nullable(); // Phone can be optional
            
            // REMOVED: $table->rememberToken(); (Not needed for a data table)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations (drops the table).
     */
    public function down(): void
    {
        // FIX: Use the plural table name for dropping
        Schema::dropIfExists('hotels');
    }
};
