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
        Schema::create('restaurant_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('category', ['appetizer', 'main_course', 'dessert', 'beverage', 'breakfast', 'lunch', 'dinner']);
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->json('ingredients')->nullable(); // Array of inventory item IDs
            $table->json('allergens')->nullable(); // nuts, dairy, gluten, etc.
            $table->integer('preparation_time')->nullable(); // in minutes
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_vegan')->default(false);
            $table->boolean('is_spicy')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->decimal('cost_price', 8, 2)->nullable();
            $table->text('chef_notes')->nullable();
            $table->timestamps();

            $table->index(['category', 'is_available']);
            $table->index(['is_featured', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_menus');
    }
};
