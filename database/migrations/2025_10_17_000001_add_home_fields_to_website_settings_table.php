<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->string('home_about_title')->nullable();
            $table->text('home_about_text')->nullable();
            $table->string('home_stay_title')->nullable();
            $table->string('home_eat_title')->nullable();
            $table->string('home_gallery_title')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_about_title',
                'home_about_text',
                'home_stay_title',
                'home_eat_title',
                'home_gallery_title',
            ]);
        });
    }
};

