<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds the new 'notes' column to the existing cache_locks table.
     */
    public function up(): void
    {
        // We use Schema::table() when we are modifying an existing table, 
        // not creating a new one.
        Schema::table('hotels', function (Blueprint $table) {
            // Adds a string column that can be NULL, placed after the 'owner' column.
            $table->string('image')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Undoes the change by dropping the 'notes' column.
     */
    public function down(): void
    {
        // The down method must be the exact inverse of the up method.
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
