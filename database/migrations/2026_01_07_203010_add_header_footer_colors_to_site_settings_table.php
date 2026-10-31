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
            $table->string('header_bg_color')->nullable()->after('header_menu');
            $table->string('header_text_color')->nullable()->after('header_bg_color');
            $table->string('footer_bg_color')->nullable()->after('footer_menu');
            $table->string('footer_text_color')->nullable()->after('footer_bg_color');
            $table->boolean('show_scroll_buttons')->default(true)->after('footer_text_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['header_bg_color', 'header_text_color', 'footer_bg_color', 'footer_text_color', 'show_scroll_buttons']);
        });
    }
};
