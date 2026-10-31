<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->string('subtitle')->nullable()->after('slug');
            $table->integer('stars')->default(5)->after('subtitle');
        });

        // Generate slugs for existing records
        $roomTypes = \App\Models\RoomType::all();
        foreach ($roomTypes as $roomType) {
            $roomType->slug = Str::slug($roomType->name);
            $roomType->save();
        }
    }

    public function down(): void
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->dropColumn(['slug', 'subtitle', 'stars']);
        });
    }
};

