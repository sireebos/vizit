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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique();
            $table->morphs('payable'); // booking, restaurant_order, bar_order
            $table->foreignId('guest_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('processed_by')->constrained('users')->onDelete('restrict');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer', 'mobile_payment', 'cheque']);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'cancelled'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->string('reference_number')->nullable();
            $table->json('payment_details')->nullable(); // card details, bank info, etc.
            $table->text('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->decimal('refund_amount', 10, 2)->default(0);
            $table->timestamp('refunded_at')->nullable();
            $table->foreignId('refunded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('refund_reason')->nullable();
            $table->timestamps();

            $table->index(['status', 'processed_at']);
            $table->index('payment_number');
            $table->index(['guest_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
