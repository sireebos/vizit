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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Single, Double, Suite, Deluxe, etc.
            $table->text('description')->nullable();
            $table->integer('max_occupancy');
            $table->integer('max_adults');
            $table->integer('max_children');
            $table->decimal('base_price', 10, 2);
            $table->json('amenities')->nullable(); // TV, AC, WiFi, etc.
            $table->json('images')->nullable(); // Array of image URLs
            $table->decimal('size_sqft', 8, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
