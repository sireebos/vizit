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
        Schema::create('room_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_type_id')->constrained()->onDelete('cascade');
            $table->string('season_name'); // Regular, Peak, Off-Season, Holiday
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('weekly_rate', 10, 2)->nullable();
            $table->decimal('monthly_rate', 10, 2)->nullable();
            $table->decimal('weekend_rate', 10, 2)->nullable();
            $table->integer('minimum_stay')->default(1);
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0); // Higher priority overrides lower
            $table->timestamps();

            $table->index(['room_type_id', 'start_date', 'end_date']);
            $table->index(['is_active', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_prices');
    }
};
