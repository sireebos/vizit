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
            // Subscribe Section Settings
            $table->string('subscribe_style')->default('classic')->nullable(); // classic, modern, minimal, pill, glassmorphism, gradient
            $table->string('subscribe_title')->nullable();
            $table->string('subscribe_subtitle')->nullable();
            $table->string('subscribe_placeholder')->nullable();
            
            // Subscribe Input Styling
            $table->string('subscribe_input_bg')->nullable();
            $table->string('subscribe_input_text')->nullable();
            $table->string('subscribe_input_border')->nullable();
            $table->string('subscribe_input_border_radius')->nullable();
            
            // Subscribe Button Styling
            $table->string('subscribe_btn_bg')->nullable();
            $table->string('subscribe_btn_text')->nullable();
            $table->string('subscribe_btn_hover_bg')->nullable();
            $table->string('subscribe_btn_hover_text')->nullable();
            $table->string('subscribe_btn_border_radius')->nullable();
            $table->string('subscribe_btn_icon')->nullable();
            $table->boolean('subscribe_btn_icon_only')->default(false);
            
            // Subscribe Container Styling  
            $table->string('subscribe_container_bg')->nullable();
            $table->string('subscribe_container_shadow')->nullable();
            $table->boolean('subscribe_show_section')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'subscribe_style',
                'subscribe_title',
                'subscribe_subtitle',
                'subscribe_placeholder',
                'subscribe_input_bg',
                'subscribe_input_text',
                'subscribe_input_border',
                'subscribe_input_border_radius',
                'subscribe_btn_bg',
                'subscribe_btn_text',
                'subscribe_btn_hover_bg',
                'subscribe_btn_hover_text',
                'subscribe_btn_border_radius',
                'subscribe_btn_icon',
                'subscribe_btn_icon_only',
                'subscribe_container_bg',
                'subscribe_container_shadow',
                'subscribe_show_section',
            ]);
        });
    }
};
