<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\RestaurantMenu;
use App\Models\SiteSettings;
use App\Models\HomePageSettings;
use App\Models\AboutPageSettings;
use App\Models\ContactPageSettings;
use App\Models\ServicesPageSettings;
use App\Models\RestaurantPageSettings;
use App\Models\RoomsPageSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VizitHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@vizithotel.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
                'status' => 'active',
            ]
        );

        // Seed Site Settings
        SiteSettings::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Vizit Hotel & Suites',
                'header_phone' => '+234 816 325 9205',
                'header_email' => 'info@Vizithotel&suites.com',
                'header_address' => '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria',
                'footer_subtitle' => 'get in touch',
                'footer_title' => 'contact us today',
                'footer_about' => 'Vizit Hotel & Suites offers an exceptional blend of luxury accommodation and vibrant entertainment in the heart of Lagos. Experience Nigerian hospitality at its finest with world-class amenities and personalized service.',
                'footer_phone' => '+234 816 325 9205',
                'footer_email' => 'reservations@Vizithotel&suites.com',
                'footer_address' => '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria',
                'footer_copyright' => '© 2025 Vizit Hotel & Suites. All rights reserved.',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
                'opening_hours' => '24 Hours',
                'currency_symbol' => '₦',
                'currency_code' => 'NGN',
                'social_instagram' => 'https://www.instagram.com/vizit_hotelsuites',
                'social_facebook' => 'https://www.booking.com/hotel/ng/vizit-amp-suites.html',
                'social_tripadvisor' => 'https://www.tripadvisor.com/Hotel_Review-g298361-d33974433-Reviews-Vizit_Hotel_Suites-Benin_City_Edo_State.html',
                'notification_email' => 'admin@Vizithotel&suites.com',
            ]
        );

        // Seed Room Types
        $roomTypes = [
            [
                'name' => 'Pearl Room',
                'slug' => 'pearl-room',
                'description' => 'Comfortable and well-equipped room offering excellent value. Features all essential amenities for a pleasant stay.',
                'base_price' => 43500,
                'max_occupancy' => 2,
                'max_adults' => 2,
                'max_children' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Crest Room',
                'slug' => 'crest-room',
                'description' => 'Our Crest Rooms offer the perfect balance of comfort and style. Enjoy modern amenities, plush furnishings, and thoughtful touches that make your stay memorable. Ideal for both business and leisure travelers.',
                'base_price' => 60000,
                'max_occupancy' => 2,
                'max_adults' => 2,
                'max_children' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Royal Crest Room',
                'slug' => 'royal-crest-room',
                'description' => 'Rest peacefully on our premium king-sized beds featuring Egyptian cotton linens, memory foam mattresses, and luxury pillows for the ultimate sleep experience.',
                'base_price' => 65000,
                'max_occupancy' => 3,
                'max_adults' => 2,
                'max_children' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Rosewood Suite',
                'slug' => 'rosewood-suite',
                'description' => 'The pinnacle of luxury with separate living area / meeting area, featuring a premium bedding and stunning city views, memory foam mattresses, and luxury pillows for the ultimate sleep experience.',
                'base_price' => 85000,
                'max_occupancy' => 4,
                'max_adults' => 3,
                'max_children' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'The Monarch',
                'slug' => 'the-monarch',
                'description' => 'The Perfect comfort for family featuring double bed, Nice views. Perfect for Family getaway and special occasions.',
                'base_price' => 128000,
                'max_occupancy' => 5,
                'max_adults' => 4,
                'max_children' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($roomTypes as $type) {
            RoomType::updateOrCreate(['slug' => $type['slug']], $type);
        }

        // Seed Rooms (5 of each type)
        $roomTypeIds = RoomType::all();
        $roomNumber = 100;
        $floors = ['Ground', '1st', '2nd', '3rd', '4th', '5th'];
        $floorIndex = 0;
        
        foreach ($roomTypeIds as $roomType) {
            for ($i = 1; $i <= 5; $i++) {
                Room::updateOrCreate(
                    ['room_number' => $roomNumber],
                    [
                        'room_type_id' => $roomType->id,
                        'floor' => $floors[$floorIndex % count($floors)],
                        'status' => 'available',
                    ]
                );
                $roomNumber++;
                if ($i % 5 == 0) {
                    $floorIndex++;
                }
            }
        }

        // Seed Home Page Settings
        HomePageSettings::updateOrCreate(
            ['id' => 1],
            [
                'sections' => json_encode([
                    'hero' => true,
                    'intro' => true,
                    'features' => true,
                    'services' => true,
                    'amenities' => true,
                    'rooms' => true,
                    'testimonials' => true,
                    'video' => true,
                    'restaurants' => true,
                ]),
                'section_order' => json_encode([
                    'hero',
                    'intro',
                    'features',
                    'services',
                    'amenities',
                    'rooms',
                    'testimonials',
                    'video',
                    'restaurants',
                ]),
                'page_styles' => json_encode([
                    'primary_color' => '#1a472a',
                    'secondary_color' => '#d4af37',
                ]),
                'content' => json_encode([
                    'seo_title' => 'Vizit Hotel & Suites - Luxury Accommodation in Benin city, Edo State Nigeria',
                    'seo_description' => 'Experience unparalleled luxury at Vizit Hotel & Suites in Benin city, Edo State. Premium rooms, exquisite dining, refreshing pool, and world-class bar services await you.',
                    'hero_title' => 'Experience<br>True Luxury',
                    'intro_subtitle' => 'Vizit Hotel & Suites',
                    'intro_title' => 'Welcome to a World of Elegance',
                    'intro_text' => 'Nestled in the vibrant heart of Benin City, Edo state, Vizit Hotel & Suites redefines luxury hospitality in Nigeria. Our establishment combines sophisticated accommodation with exceptional dining and entertainment, creating an unforgettable experience for business and leisure travelers alike. From our meticulously designed rooms to our world-class restaurant and bar, every detail is crafted to exceed your expectations.',
                    'amenities_subtitle' => 'premium amenities',
                    'amenities_title' => 'Luxury at Every Turn',
                    'rooms_subtitle' => 'accommodation',
                    'rooms_title' => 'Our Premium Rooms',
                ]),
            ]
        );

        // Seed About Page Settings
        AboutPageSettings::updateOrCreate(
            ['id' => 1],
            [
                'sections' => json_encode([
                    'hero' => true,
                    'video' => true,
                    'services' => true,
                    'features' => true,
                    'testimonials' => true,
                ]),
                'section_order' => json_encode([
                    'hero',
                    'video',
                    'services',
                    'features',
                    'testimonials',
                ]),
                'content' => json_encode([
                    'seo_title' => 'About Us - Vizit Hotel & Suites | Our Story',
                    'seo_description' => 'Learn about Vizit Hotel & Suites commitment to excellence in hospitality. Discover our story, values, and dedication to providing exceptional guest experiences in Benin city.',
                    'hero_title' => 'Our Story',
                    'video_subtitle' => 'A Legacy of Excellence',
                    'services_subtitle' => 'why choose us',
                    'services_title' => 'Exceptional Hospitality',
                ]),
            ]
        );

        // Seed Contact Page Settings
        ContactPageSettings::updateOrCreate(
            ['id' => 1],
            [
                'sections' => json_encode([
                    'hero' => true,
                    'video' => true,
                    'form' => true,
                    'info' => true,
                ]),
                'section_order' => json_encode([
                    'hero',
                    'video',
                    'form',
                    'info',
                ]),
                'content' => json_encode([
                    'seo_title' => 'Contact Us - Vizit Hotel & Suites',
                    'seo_description' => 'Get in touch with Vizit Hotel & Suites. Contact us for reservations, inquiries, or to plan your perfect stay in benin city, edo state Nigeria.',
                    'hero_title' => 'Contact Us',
                    'form_subtitle' => 'reach out to us',
                    'form_title' => 'Send Us a Message',
                    'info_address' => '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria',
                    'info_city' => 'Benin city, Edo state',
                    'info_phone' => '+234 816 325 9205',
                    'info_email' => 'reservations@Vizithotel&suites.com',
                    'info_check_in' => '2:00 PM',
                    'info_check_out' => '12:00 PM',
                    'info_hours' => '24 Hours Daily',
                ]),
            ]
        );

        // Seed Services Page Settings
        ServicesPageSettings::updateOrCreate(
            ['id' => 1],
            [
                'sections' => json_encode([
                    'hero' => true,
                    'video' => true,
                    'services' => true,
                    'offers' => true,
                ]),
                'section_order' => json_encode([
                    'hero',
                    'video',
                    'services',
                    'offers',
                ]),
                'content' => json_encode([
                    'seo_title' => 'Our Services - Vizit hotel & suites',
                    'seo_description' => 'Discover the premium services at Vizit hotel & suites including mini mart, restaurant, pool, Bar and more. Experience luxury hospitality in Benin city.',
                    'hero_title' => 'Our Services',
                    'services_subtitle' => 'premium offerings',
                    'services_title' => 'World-Class Amenities',
                    'offers_subtitle' => 'exclusive services',
                    'offers_title' => 'What We Offer',
                ]),
            ]
        );

        // Seed Restaurant Page Settings
        RestaurantPageSettings::updateOrCreate(
            ['id' => 1],
            [
                'sections' => json_encode([
                    'hero' => true,
                    'video' => true,
                    'menu' => true,
                ]),
                'section_order' => json_encode([
                    'hero',
                    'video',
                    'menu',
                ]),
                'content' => json_encode([
                    'seo_title' => 'Restaurant & Dining - Vizit Hotel & Suites',
                    'seo_description' => 'Enjoy exceptional dining at Vizit Hotel & Suites. Our restaurants serve authentic Nigerian cuisine and international dishes prepared by expert chefs.',
                    'hero_title' => 'Restaurant',
                    'menu_subtitle' => 'our specialties',
                    'menu_title' => 'Featured Menu',
                ]),
            ]
        );

        // Seed Rooms Page Settings
        RoomsPageSettings::updateOrCreate(
            ['id' => 1],
            [
                'sections' => json_encode([
                    'hero' => true,
                    'rooms' => true,
                    'amenities' => true,
                ]),
                'section_order' => json_encode([
                    'hero',
                    'rooms',
                    'amenities',
                ]),
                'content' => json_encode([
                    'seo_title' => 'Our Rooms - Vizit Hotel & Suites',
                    'seo_description' => 'Discover our range of luxury rooms at Vizit Hotel & Suites in Benin city.',
                    'hero_title' => 'Our Rooms',
                ]),
            ]
        );

        // Seed Menu Items (Restaurant)
        $menuItems = [
            // Meals
            ['name' => 'Jollof Rice', 'category' => 'main_course', 'price' => 3000],
            ['name' => 'Fried Rice', 'category' => 'main_course', 'price' => 3000],
            ['name' => 'White Rice', 'category' => 'main_course', 'price' => 3000],
            ['name' => 'Basmati Rice', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Coconut Rice (On Request)', 'category' => 'main_course', 'price' => 3000],
            ['name' => 'Special Fried Rice (On Request)', 'category' => 'main_course', 'price' => 8000],
            ['name' => 'Native Rice (On Request)', 'category' => 'main_course', 'price' => 8000],
            ['name' => 'Jamaican Rice (On Request)', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Seafood Jollof (On Request)', 'category' => 'main_course', 'price' => 8000],
            ['name' => 'Signature Rice (On Request)', 'category' => 'main_course', 'price' => 8000],
            
            // Pasta
            ['name' => 'Vegetable Noodles', 'category' => 'main_course', 'price' => 3000],
            ['name' => 'Jollof Spaghetti', 'category' => 'main_course', 'price' => 3000],
            ['name' => 'White Spaghetti', 'category' => 'main_course', 'price' => 3000],
            ['name' => 'Spaghetti Bolognese', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Stir Fry Pasta', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Alfredo Pasta (Creamy) (On Request)', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Seafood Pasta (On Request)', 'category' => 'main_course', 'price' => 8000],
            ['name' => 'Penne Arabiata (On Request)', 'category' => 'main_course', 'price' => 6000],
            
            // Proteins
            ['name' => 'Turkey', 'category' => 'main_course', 'price' => 8000],
            ['name' => 'Chicken', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Goat Meat', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Beef', 'category' => 'main_course', 'price' => 5000],
            ['name' => 'Snail (One Portion)', 'category' => 'main_course', 'price' => 10000],
            ['name' => 'Sauced Kpomo', 'category' => 'main_course', 'price' => 5000],
            ['name' => 'Assorted', 'category' => 'main_course', 'price' => 7000],
            ['name' => 'Cow Head', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Meluza Fish', 'category' => 'main_course', 'price' => 6000],
            ['name' => 'Croaker Fish', 'category' => 'main_course', 'price' => 9000],
            ['name' => 'Titus Fish', 'category' => 'main_course', 'price' => 8000],
            ['name' => 'Catfish (Half)', 'category' => 'main_course', 'price' => 8000],
            
            // Soups
            ['name' => 'Egusi Soup', 'category' => 'appetizer', 'price' => 3000],
            ['name' => 'Ogbono Soup', 'category' => 'appetizer', 'price' => 3000],
            ['name' => 'Banga Soup', 'category' => 'appetizer', 'price' => 3000],
            ['name' => 'Black Soup', 'category' => 'appetizer', 'price' => 3000],
            ['name' => 'Vegetable Soup', 'category' => 'appetizer', 'price' => 4000],
            ['name' => 'Okro Soup', 'category' => 'appetizer', 'price' => 4000],
            ['name' => 'Bitterleaf Soup', 'category' => 'appetizer', 'price' => 3000],
            ['name' => 'Oha Soup', 'category' => 'appetizer', 'price' => 3000],
            
            // Drinks
            ['name' => 'Water', 'category' => 'beverage', 'price' => 800],
            ['name' => 'Fresh Juice', 'category' => 'beverage', 'price' => 3000],
            ['name' => 'Amstel Malt', 'category' => 'beverage', 'price' => 2000],
            ['name' => 'Heineken (Medium)', 'category' => 'beverage', 'price' => 2500],
            ['name' => 'Heineken (Large)', 'category' => 'beverage', 'price' => 3000],
        ];

        foreach ($menuItems as $item) {
            RestaurantMenu::updateOrCreate(
                ['name' => $item['name']],
                [
                    'category' => $item['category'],
                    'price' => $item['price'],
                    'is_available' => true,
                ]
            );
        }

        $this->command->info('Vizit Hotel database seeded successfully!');
    }
}

