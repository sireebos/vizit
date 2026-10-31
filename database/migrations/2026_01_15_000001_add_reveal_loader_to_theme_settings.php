<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->string('reveal_color')->nullable()->default('#1a2a3a')->after('footer_text_color');
            $table->string('loader_image')->nullable()->after('reveal_color');
            $table->string('loader_bg_color')->nullable()->default('#ffffff')->after('loader_image');
        });
    }

    public function down(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->dropColumn(['reveal_color', 'loader_image', 'loader_bg_color']);
        });
    }
};
