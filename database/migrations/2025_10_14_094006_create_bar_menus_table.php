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
        Schema::create('bar_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('category', ['beer', 'wine', 'spirits', 'cocktail', 'mocktail', 'soft_drink', 'coffee', 'tea']);
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->json('ingredients')->nullable(); // Array of inventory item IDs
            $table->decimal('alcohol_content', 5, 2)->nullable(); // Percentage
            $table->string('serving_size')->nullable(); // 330ml, 750ml, etc.
            $table->boolean('is_alcoholic')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->decimal('cost_price', 8, 2)->nullable();
            $table->text('preparation_notes')->nullable();
            $table->integer('preparation_time')->nullable(); // in minutes
            $table->timestamps();

            $table->index(['category', 'is_available']);
            $table->index(['is_featured', 'sort_order']);
            $table->index('is_alcoholic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_menus');
    }
};
