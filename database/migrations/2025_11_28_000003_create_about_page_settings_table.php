<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->json('sections')->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });

        // Insert default row
        DB::table('about_page_settings')->insert([
            'seo_title' => 'About Us - Kuwait Cabin Hotel Bar',
            'seo_description' => 'Learn more about Kuwait Cabin Hotel Bar - our story, our values, and our commitment to luxury hospitality.',
            'sections' => json_encode([]),
            'content' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('about_page_settings');
    }
};

