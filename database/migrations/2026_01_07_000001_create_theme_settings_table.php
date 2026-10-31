<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();
            
            // Colors
            $table->string('primary_color')->default('#aa8453');
            $table->string('secondary_color')->default('#1b1b1b');
            $table->string('accent_color')->default('#c9a66b');
            $table->string('text_color')->default('#666666');
            $table->string('heading_color')->default('#1b1b1b');
            $table->string('link_color')->default('#aa8453');
            $table->string('button_color')->default('#aa8453');
            $table->string('button_hover_color')->default('#8a6a43');
            $table->string('footer_bg_color')->default('#1b1b1b');
            $table->string('footer_text_color')->default('#999999');
            
            // Typography
            $table->string('heading_font')->default('Poppins');
            $table->string('body_font')->default('Roboto');
            
            // Header Settings
            $table->string('header_style')->default('dark'); // dark, light, transparent
            $table->boolean('sticky_header')->default(true);
            
            // Button Settings
            $table->string('button_style')->default('rounded'); // rounded, square, pill
            
            // Layout Settings
            $table->string('layout_style')->default('wide'); // wide, boxed
            
            // Custom CSS
            $table->text('custom_css')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theme_settings');
    }
};
