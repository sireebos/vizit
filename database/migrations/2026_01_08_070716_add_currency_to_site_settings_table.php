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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('currency_symbol', 10)->default('₦')->after('notification_email');
            $table->string('currency_code', 10)->default('NGN')->after('currency_symbol');
            $table->string('currency_position', 10)->default('before')->after('currency_code'); // before or after
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['currency_symbol', 'currency_code', 'currency_position']);
        });
    }
};
