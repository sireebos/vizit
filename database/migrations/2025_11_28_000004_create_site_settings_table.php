<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            
            // Logo & Branding
            $table->string('site_name')->default('Kuwait Cabin Hotel Bar');
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            
            // Header Info
            $table->string('header_phone')->nullable();
            $table->string('header_email')->nullable();
            $table->text('header_address')->nullable();
            
            // Footer Info
            $table->text('footer_about')->nullable();
            $table->string('footer_phone')->nullable();
            $table->string('footer_email')->nullable();
            $table->text('footer_address')->nullable();
            $table->string('footer_copyright')->nullable();
            
            // Social Media
            $table->string('social_facebook')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_tripadvisor')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

