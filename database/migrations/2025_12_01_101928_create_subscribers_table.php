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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('source')->default('footer'); // footer, contact_page, popup, etc.
            $table->string('status')->default('active'); // active, unsubscribed
            $table->timestamp('subscribed_at')->useCurrent();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });

        // Also add notification email field to site_settings
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('notification_email')->nullable()->after('social_tripadvisor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('notification_email');
        });
    }
};
