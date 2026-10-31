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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique(); // Stock Keeping Unit
            $table->foreignId('category_id')->constrained('inventory_categories')->onDelete('restrict');
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('unit'); // kg, liter, piece, bottle, etc.
            $table->decimal('unit_cost', 10, 2);
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->integer('current_stock')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->integer('maximum_stock')->nullable();
            $table->integer('reorder_level')->default(0);
            $table->string('storage_location')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('supplier_code')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('track_expiry')->default(false);
            $table->boolean('is_perishable')->default(false);
            $table->timestamps();

            $table->index(['category_id', 'is_active']);
            $table->index(['current_stock', 'minimum_stock']);
            $table->index('sku');
            $table->index('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
