<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Use an enum for predefined roles, which is best practice
            $table->enum('role', ['admin', 'user', 'public','Super_admin'])
                  ->default('user')
                  ->after('email') // Place the column after 'email' for readability
                  ->comment('User role for authorization checks');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};