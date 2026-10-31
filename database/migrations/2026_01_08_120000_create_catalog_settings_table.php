<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog_settings', function (Blueprint $table) {
            $table->id();
            
            // Display Settings
            $table->enum('display_mode', ['grid', 'list', 'compact'])->default('grid');
            $table->integer('items_per_row')->default(3); // 2, 3, 4, 5
            $table->boolean('show_images')->default(true);
            $table->boolean('show_descriptions')->default(true);
            $table->boolean('show_prices')->default(true);
            $table->boolean('show_featured_badge')->default(true);
            $table->boolean('show_item_count')->default(true);
            
            // Default Tab
            $table->enum('default_tab', ['drinks', 'food', 'rooms'])->default('drinks');
            
            // Section Visibility
            $table->boolean('show_drinks_section')->default(true);
            $table->boolean('show_food_section')->default(true);
            $table->boolean('show_rooms_section')->default(true);
            $table->boolean('show_qrcode_tab')->default(true);
            
            // Header Settings
            $table->string('tagline')->nullable();
            $table->boolean('show_contact_bar')->default(true);
            $table->boolean('show_phone')->default(true);
            $table->boolean('show_email')->default(true);
            $table->boolean('show_address')->default(true);
            $table->boolean('show_website')->default(true);
            
            // Color Settings
            $table->string('primary_color', 7)->default('#b59f6a');
            $table->string('background_color', 7)->default('#1a1a2e');
            $table->string('card_bg_color', 7)->default('#16213e');
            $table->string('text_color', 7)->default('#eeeeee');
            $table->string('muted_text_color', 7)->default('#aaaaaa');
            $table->string('price_color', 7)->nullable(); // null = use primary color
            
            // Footer Settings
            $table->boolean('show_footer')->default(true);
            $table->boolean('show_back_button')->default(true);
            
            // Custom CSS
            $table->text('custom_css')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_settings');
    }
};
