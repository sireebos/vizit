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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->foreignId('room_type_id')->constrained()->onDelete('restrict');
            $table->enum('floor', ['Ground', '1st', '2nd', '3rd', '4th', '5th']);
            $table->enum('status', ['available', 'occupied', 'maintenance', 'cleaning', 'out_of_order'])->default('available');
            $table->text('description')->nullable();
            $table->json('features')->nullable(); // Balcony, Sea View, etc.
            $table->json('images')->nullable();
            $table->timestamp('last_cleaned_at')->nullable();
            $table->timestamp('last_maintenance_at')->nullable();
            $table->text('maintenance_notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['status', 'is_active']);
            $table->index('room_type_id');
            $table->index('floor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
