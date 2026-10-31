<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\RestaurantMenu;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample room types
        $deluxe = RoomType::create([
            'name' => 'Deluxe Room',
            'description' => 'Spacious room with city view',
            'base_price' => 150.00,
            'max_occupancy' => 2,
            'max_adults' => 2,
            'max_children' => 1,
            'amenities' => ['wifi', 'tv', 'ac', 'minibar'],
            'images' => ['deluxe1.jpg', 'deluxe2.jpg'],
            'is_active' => true
        ]);

        $suite = RoomType::create([
            'name' => 'Executive Suite',
            'description' => 'Luxury suite with ocean view',
            'base_price' => 300.00,
            'max_occupancy' => 4,
            'max_adults' => 2,
            'max_children' => 2,
            'amenities' => ['wifi', 'tv', 'ac', 'minibar', 'balcony', 'jacuzzi'],
            'images' => ['suite1.jpg', 'suite2.jpg'],
            'is_active' => true
        ]);

        $standard = RoomType::create([
            'name' => 'Standard Room',
            'description' => 'Comfortable room with essential amenities',
            'base_price' => 100.00,
            'max_occupancy' => 2,
            'max_adults' => 2,
            'max_children' => 0,
            'amenities' => ['wifi', 'tv', 'ac'],
            'images' => ['standard1.jpg'],
            'is_active' => true
        ]);

        // Create sample rooms
        $rooms = [];
        
        // Standard rooms (101-110)
        for ($i = 101; $i <= 110; $i++) {
            $status = match (true) {
                $i <= 105 => 'available',
                $i <= 108 => 'occupied',
                $i == 109 => 'maintenance',
                default => 'cleaning'
            };
            
            $rooms[] = Room::create([
                'room_number' => (string)$i,
                'room_type_id' => $standard->id,
                'floor' => '1',
                'status' => $status,
                'description' => "Standard room {$i}",
                'features' => ['wifi', 'tv', 'ac'],
                'is_active' => true,
                'last_cleaned_at' => now()->subHours(rand(1, 48))
            ]);
        }

        // Deluxe rooms (201-210)
        for ($i = 201; $i <= 210; $i++) {
            $status = match (true) {
                $i <= 203 => 'available',
                $i <= 207 => 'occupied',
                $i == 208 => 'maintenance',
                default => 'cleaning'
            };
            
            $rooms[] = Room::create([
                'room_number' => (string)$i,
                'room_type_id' => $deluxe->id,
                'floor' => '2',
                'status' => $status,
                'description' => "Deluxe room {$i}",
                'features' => ['wifi', 'tv', 'ac', 'minibar'],
                'is_active' => true,
                'last_cleaned_at' => now()->subHours(rand(1, 48))
            ]);
        }

        // Executive suites (301-305)
        for ($i = 301; $i <= 305; $i++) {
            $status = match (true) {
                $i <= 301 => 'available',
                $i <= 304 => 'occupied',
                default => 'cleaning'
            };
            
            $rooms[] = Room::create([
                'room_number' => (string)$i,
                'room_type_id' => $suite->id,
                'floor' => '3',
                'status' => $status,
                'description' => "Executive suite {$i}",
                'features' => ['wifi', 'tv', 'ac', 'minibar', 'balcony', 'jacuzzi'],
                'is_active' => true,
                'last_cleaned_at' => now()->subHours(rand(1, 48))
            ]);
        }

        // Create sample guests
        $guests = [];
        $guestNames = [
            ['John', 'Smith', 'john.smith@email.com'],
            ['Sarah', 'Johnson', 'sarah.johnson@email.com'],
            ['Michael', 'Brown', 'michael.brown@email.com'],
            ['Emily', 'Davis', 'emily.davis@email.com'],
            ['David', 'Wilson', 'david.wilson@email.com'],
            ['Lisa', 'Anderson', 'lisa.anderson@email.com'],
            ['Robert', 'Taylor', 'robert.taylor@email.com'],
            ['Jennifer', 'Thomas', 'jennifer.thomas@email.com'],
        ];

        foreach ($guestNames as $index => $guestData) {
            $guests[] = Guest::create([
                'first_name' => $guestData[0],
                'last_name' => $guestData[1],
                'email' => $guestData[2],
                'phone' => '+1-555-' . str_pad($index + 1000, 4, '0', STR_PAD_LEFT),
                'date_of_birth' => Carbon::now()->subYears(rand(25, 65))->subDays(rand(1, 365)),
                'gender' => rand(0, 1) ? 'male' : 'female',
                'nationality' => 'US',
                'id_type' => 'passport',
                'id_number' => 'US' . str_pad($index + 100000, 6, '0', STR_PAD_LEFT),
                'address' => (100 + $index) . ' Main Street',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'postal_code' => '10001',
                'is_vip' => $index < 2, // First 2 guests are VIP
                'is_blacklisted' => false,
            ]);
        }

        // Create sample bookings
        $admin = \App\Models\User::where('email', 'admin@vermonhotel.com')->first();
        
        foreach ($guests as $index => $guest) {
            if ($index < 6) { // Create bookings for first 6 guests
                $room = $rooms[array_rand($rooms)];
                $checkIn = Carbon::now()->addDays(rand(-5, 5));
                $checkOut = $checkIn->copy()->addDays(rand(1, 7));
                
                $booking = Booking::create([
                    'guest_id' => $guest->id,
                    'room_id' => $room->id,
                    'created_by' => $admin->id,
                    'check_in_date' => $checkIn,
                    'check_out_date' => $checkOut,
                    'adults' => rand(1, 2),
                    'children' => rand(0, 1),
                    'nights' => $checkIn->diffInDays($checkOut),
                    'booking_type' => 'daily',
                    'status' => $index < 3 ? 'checked_in' : 'confirmed',
                    'room_rate' => $room->roomType->base_price,
                    'total_amount' => $room->roomType->base_price * $checkIn->diffInDays($checkOut),
                    'tax_amount' => ($room->roomType->base_price * $checkIn->diffInDays($checkOut)) * 0.1,
                    'service_charge' => ($room->roomType->base_price * $checkIn->diffInDays($checkOut)) * 0.05,
                    'paid_amount' => $index < 4 ? ($room->roomType->base_price * $checkIn->diffInDays($checkOut)) * 1.15 : 0,
                    'balance_amount' => $index >= 4 ? ($room->roomType->base_price * $checkIn->diffInDays($checkOut)) * 1.15 : 0,
                    'payment_status' => $index < 4 ? 'paid' : 'pending',
                ]);

                // Create payments for paid bookings
                if ($index < 4) {
                    Payment::create([
                        'payment_number' => 'PAY' . date('Ymd') . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                        'payable_type' => Booking::class,
                        'payable_id' => $booking->id,
                        'guest_id' => $guest->id,
                        'processed_by' => $admin->id,
                        'amount' => $booking->total_amount + $booking->tax_amount + $booking->service_charge,
                        'payment_method' => ['cash', 'card', 'bank_transfer'][rand(0, 2)],
                        'status' => 'completed',
                        'processed_at' => now()->subHours(rand(1, 48)),
                    ]);
                }
            }
        }

        // Create sample restaurant menu items
        $menuCategories = [
            'appetizer' => [
                ['Caesar Salad', 'Fresh romaine lettuce with parmesan and croutons', 12.99],
                ['Chicken Wings', 'Spicy buffalo wings with blue cheese dip', 14.99],
                ['Bruschetta', 'Toasted bread with tomatoes and basil', 9.99],
            ],
            'main_course' => [
                ['Grilled Salmon', 'Atlantic salmon with lemon butter sauce', 28.99],
                ['Ribeye Steak', 'Premium cut with garlic mashed potatoes', 35.99],
                ['Chicken Parmesan', 'Breaded chicken with marinara and mozzarella', 22.99],
                ['Vegetarian Pasta', 'Penne with seasonal vegetables', 18.99],
            ],
            'dessert' => [
                ['Chocolate Cake', 'Rich chocolate cake with vanilla ice cream', 8.99],
                ['Tiramisu', 'Classic Italian dessert', 7.99],
                ['Cheesecake', 'New York style with berry compote', 6.99],
            ],
        ];

        foreach ($menuCategories as $category => $items) {
            foreach ($items as $index => $item) {
                RestaurantMenu::create([
                    'name' => $item[0],
                    'description' => $item[1],
                    'category' => $category,
                    'price' => $item[2],
                    'cost_price' => $item[2] * 0.4, // 40% cost ratio
                    'preparation_time' => rand(10, 45),
                    'is_vegetarian' => str_contains(strtolower($item[0]), 'vegetarian'),
                    'is_vegan' => false,
                    'is_spicy' => str_contains(strtolower($item[1]), 'spicy'),
                    'is_available' => true,
                    'is_featured' => $index == 0, // First item in each category is featured
                    'sort_order' => $index + 1,
                ]);
            }
        }

        $this->command->info('Sample data created successfully!');
    }
}
