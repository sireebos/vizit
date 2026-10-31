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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Kuwait Cabin Hotel Bar');
            $table->text('site_description')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();

            // Theme Colors
            $table->string('primary_color')->default('#000000');
            $table->string('secondary_color')->default('#ffffff');
            $table->string('accent_color')->default('#333333');
            $table->string('text_primary')->default('#ffffff');
            $table->string('text_secondary')->default('#cccccc');
            $table->string('background_primary')->default('#000000');
            $table->string('background_secondary')->default('#111111');
            $table->string('background_tertiary')->default('#222222');
            $table->string('border_color')->default('#333333');

            // Fonts
            $table->string('font_primary')->default('Arial, sans-serif');
            $table->string('font_secondary')->default('Georgia, serif');

            // Contact Info
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();

            // SEO
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
