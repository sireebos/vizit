<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the ENUM to include 'drinks'
        DB::statement("ALTER TABLE restaurant_menus MODIFY COLUMN category ENUM('appetizer', 'main_course', 'dessert', 'beverage', 'drinks', 'breakfast', 'lunch', 'dinner')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'drinks' from ENUM
        DB::statement("ALTER TABLE restaurant_menus MODIFY COLUMN category ENUM('appetizer', 'main_course', 'dessert', 'beverage', 'breakfast', 'lunch', 'dinner')");
    }
};
