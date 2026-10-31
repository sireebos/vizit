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
            $table->json('header_menu')->nullable();
            $table->string('footer_subtitle')->nullable();
            $table->string('footer_title')->nullable();
            $table->json('footer_menu')->nullable();
            $table->string('check_in_time')->nullable();
            $table->string('check_out_time')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('subscribe_button')->nullable();
            $table->string('partner_logo_1')->nullable();
            $table->string('partner_logo_2')->nullable();
            $table->string('partner_logo_3')->nullable();
            $table->string('partner_logo_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'header_menu',
                'footer_subtitle',
                'footer_title',
                'footer_menu',
                'check_in_time',
                'check_out_time',
                'opening_hours',
                'subscribe_button',
                'partner_logo_1',
                'partner_logo_2',
                'partner_logo_3',
                'partner_logo_4',
            ]);
        });
    }
};
