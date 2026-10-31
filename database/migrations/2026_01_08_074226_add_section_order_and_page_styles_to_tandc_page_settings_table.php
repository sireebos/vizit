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
        Schema::table('tandc_page_settings', function (Blueprint $table) {
            $table->json('section_order')->nullable()->after('sections');
            $table->json('page_styles')->nullable()->after('section_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tandc_page_settings', function (Blueprint $table) {
            $table->dropColumn(['section_order', 'page_styles']);
        });
    }
};
