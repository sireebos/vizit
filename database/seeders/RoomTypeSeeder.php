<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample room types
        RoomType::create([
            'name' => 'Deluxe Suite',
            'description' => 'Spacious and elegant suite with premium amenities, perfect for business travelers and couples seeking luxury.',
            'base_price' => 299.99,
            'max_occupancy' => 2,
            'max_adults' => 2,
            'max_children' => 0,
            'size_sqft' => 450,
            'amenities' => ['Free WiFi', 'King Size Bed', 'Mini Bar', 'City View', 'Room Service', 'Air Conditioning'],
            'images' => [
                'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800',
                'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800'
            ],
            'is_active' => true,
            'sort_order' => 1
        ]);

        RoomType::create([
            'name' => 'Standard Room',
            'description' => 'Comfortable and well-appointed room with all essential amenities for a pleasant stay.',
            'base_price' => 149.99,
            'max_occupancy' => 2,
            'max_adults' => 2,
            'max_children' => 0,
            'size_sqft' => 300,
            'amenities' => ['Free WiFi', 'Queen Size Bed', 'TV', 'Air Conditioning', 'Private Bathroom'],
            'images' => [
                'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800'
            ],
            'is_active' => true,
            'sort_order' => 2
        ]);

        RoomType::create([
            'name' => 'Family Room',
            'description' => 'Spacious room designed for families, featuring multiple beds and extra space for comfort.',
            'base_price' => 199.99,
            'max_occupancy' => 4,
            'max_adults' => 2,
            'max_children' => 2,
            'size_sqft' => 500,
            'amenities' => ['Free WiFi', '2 Queen Beds', 'TV', 'Mini Fridge', 'Air Conditioning', 'Family Friendly'],
            'images' => [
                'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800'
            ],
            'is_active' => true,
            'sort_order' => 3
        ]);
    }
}
