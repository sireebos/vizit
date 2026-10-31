<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables that need section_order and page_styles columns
     */
    protected array $tables = [
        'home_page_settings',
        'about_page_settings',
        'rooms_page_settings',
        'restaurant_page_settings',
        'contact_page_settings',
        'services_page_settings',
        'explore_page_settings',
        'rooms_gallery_page_settings',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $blueprint) use ($table) {
                    if (!Schema::hasColumn($table, 'section_order')) {
                        $blueprint->json('section_order')->nullable()->after('sections');
                    }
                    if (!Schema::hasColumn($table, 'page_styles')) {
                        $blueprint->json('page_styles')->nullable()->after('section_order');
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $blueprint) use ($table) {
                    if (Schema::hasColumn($table, 'section_order')) {
                        $blueprint->dropColumn('section_order');
                    }
                    if (Schema::hasColumn($table, 'page_styles')) {
                        $blueprint->dropColumn('page_styles');
                    }
                });
            }
        }
    }
};
