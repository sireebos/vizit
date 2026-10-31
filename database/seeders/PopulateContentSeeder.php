<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSettings;
use App\Models\HomePageSettings;
use App\Models\AboutPageSettings;
use App\Models\ContactPageSettings;
use App\Models\ServicesPageSettings;
use App\Models\RestaurantPageSettings;
use App\Models\RoomsPageSettings;
use App\Models\ExplorePageSettings;
use App\Models\TandcPageSettings;
use App\Models\RoomType;
use App\Models\RestaurantMenu;
use App\Models\WebsiteSettings;

class PopulateContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder populates all page settings with Kuwait Cabin Hotel Bar content.
     */
    public function run(): void
    {
        $this->command->info('Populating Kuwait Cabin Hotel Bar content...');
        
        $this->populateSiteSettings();
        $this->populateHomePageSettings();
        $this->populateAboutPageSettings();
        $this->populateContactPageSettings();
        $this->populateServicesPageSettings();
        $this->populateRestaurantPageSettings();
        $this->populateRoomsPageSettings();
        $this->populateExplorePageSettings();
        $this->populateTandcPageSettings();
        $this->populateRoomTypes();
        $this->populateRestaurantMenu();
        $this->populateWebsiteSettings();
        
        $this->command->info('Content population completed successfully!');
    }

    private function populateSiteSettings(): void
    {
        $this->command->info('Populating Site Settings...');
        
        SiteSettings::updateOrCreate(['id' => 1], [
            'site_name' => 'Kuwait Cabin Hotel Bar',
            'header_phone' => '+234 812 345 6789',
            'header_email' => 'info@kuwaitcabinhotel.com',
            'header_address' => '15 Victoria Island, Lagos, Nigeria',
            'footer_subtitle' => 'get in touch',
            'footer_title' => 'contact us today',
            'footer_about' => 'Kuwait Cabin Hotel Bar offers an exceptional blend of luxury accommodation and vibrant entertainment in the heart of Lagos. Experience Nigerian hospitality at its finest with world-class amenities and personalized service.',
            'footer_phone' => '+234 812 345 6789',
            'footer_email' => 'reservations@kuwaitcabinhotel.com',
            'footer_address' => '15 Victoria Island, Lagos, Nigeria',
            'footer_copyright' => '© ' . date('Y') . ' Kuwait Cabin Hotel Bar. All rights reserved.',
            'check_in_time' => '2:00 PM',
            'check_out_time' => '12:00 PM',
            'opening_hours' => '24 Hours',
            'subscribe_button' => 'subscribe',
            'social_facebook' => 'https://facebook.com/kuwaitcabinhotel',
            'social_twitter' => 'https://twitter.com/kuwaitcabinhotel',
            'social_instagram' => 'https://instagram.com/kuwaitcabinhotel',
            'social_tripadvisor' => 'https://tripadvisor.com/kuwaitcabinhotel',
            'notification_email' => 'admin@kuwaitcabinhotel.com',
            'header_menu' => json_encode([
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'About', 'url' => '/about'],
                ['label' => 'Rooms', 'url' => '/rooms'],
                ['label' => 'Restaurant', 'url' => '/restaurant'],
                ['label' => 'Services', 'url' => '/services'],
                ['label' => 'Gallery', 'url' => '/gallery'],
                ['label' => 'Contact', 'url' => '/contact'],
            ]),
            'footer_menu' => json_encode([
                ['label' => 'terms & conditions', 'url' => '/tandc'],
                ['label' => 'services', 'url' => '/services'],
                ['label' => 'restaurant', 'url' => '/restaurant'],
                ['label' => 'explore lagos', 'url' => '/explore'],
                ['label' => 'gallery & images', 'url' => '/gallery'],
            ]),
        ]);
    }

    private function populateHomePageSettings(): void
    {
        $this->command->info('Populating Home Page Settings...');
        
        HomePageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'Kuwait Cabin Hotel Bar - Luxury Accommodation in Lagos, Nigeria',
            'seo_description' => 'Experience unparalleled luxury at Kuwait Cabin Hotel Bar in Lagos. Premium rooms, exquisite dining, refreshing pool, and world-class bar services await you.',
            'sections' => [
                'hero' => ['visible' => true],
                'booking_bar' => ['visible' => true],
                'intro' => ['visible' => true],
                'features_pair' => ['visible' => true],
                'services_grid' => ['visible' => true],
                'features_grid' => ['visible' => true],
                'parallax_cta' => ['visible' => true],
                'rooms' => ['visible' => true],
                'quotes' => ['visible' => true],
                'video' => ['visible' => true],
                'restaurants' => ['visible' => true],
            ],
            'content' => [
                // Hero
                'hero_title' => 'Experience<br>True Luxury',

                // Intro
                'intro_subtitle' => 'Kuwait Cabin Hotel',
                'intro_title' => 'Welcome to a World of Elegance',
                'intro_text' => 'Nestled in the vibrant heart of Victoria Island, Lagos, Kuwait Cabin Hotel Bar redefines luxury hospitality in Nigeria. Our establishment combines sophisticated accommodation with exceptional dining and entertainment, creating an unforgettable experience for business and leisure travelers alike. From our meticulously designed rooms to our world-class restaurant and bar, every detail is crafted to exceed your expectations.',

                // Feature 1
                'feature1_label' => 'executive suite',
                'feature1_title' => 'Executive Suite',
                'feature1_text' => 'Indulge in spacious elegance with our Executive Suite featuring a private balcony, premium bedding, marble bathroom, and stunning city views. Perfect for discerning guests who appreciate the finer things in life.',
                'feature1_button_text' => 'check availability',

                // Feature 2
                'feature2_label' => 'deluxe room',
                'feature2_title' => 'Deluxe Room',
                'feature2_text' => 'Our Deluxe Rooms offer the perfect balance of comfort and style. Enjoy modern amenities, plush furnishings, and thoughtful touches that make your stay memorable. Ideal for both business and leisure travelers.',
                'feature2_button_text' => 'check availability',

                // Services Grid
                'service1_title' => 'Spa & Wellness',
                'service2_title' => 'Restaurant',
                'service3_title' => 'Swimming Pool',
                'service4_title' => 'Bar & Lounge',

                // Amenities Section
                'features_grid_subtitle' => 'premium amenities',
                'features_grid_title' => 'Luxury at Every Turn',

                'amenity1_title' => 'Smoke-Free Rooms',
                'amenity1_text' => 'All our rooms and public areas are smoke-free, ensuring a clean and fresh environment for all guests. Designated smoking areas are available for your convenience.',

                'amenity2_title' => 'Premium King Beds',
                'amenity2_text' => 'Rest peacefully on our premium king-sized beds featuring Egyptian cotton linens, memory foam mattresses, and luxury pillows for the ultimate sleep experience.',

                'amenity3_title' => 'Airport Transfer',
                'amenity3_text' => 'Complimentary airport pickup and drop-off services available for all guests. Our professional drivers ensure a comfortable journey to and from Murtala Muhammed International Airport.',

                'amenity4_title' => 'Welcome Drinks',
                'amenity4_text' => 'Start your stay with a refreshing complimentary welcome drink served upon arrival. Choose from our selection of fresh juices, cocktails, or premium beverages.',

                'amenity5_title' => 'Swimming Pool',
                'amenity5_text' => 'Dive into relaxation at our stunning rooftop swimming pool. Enjoy panoramic city views, poolside service, and a refreshing escape from Lagos\'s tropical heat.',

                'amenity6_title' => 'Breakfast Included',
                'amenity6_text' => 'Wake up to a lavish breakfast buffet featuring Nigerian and continental options. Fresh fruits, pastries, hot dishes, and premium coffee await you each morning.',

                // Rooms Section
                'rooms_subtitle' => 'accommodation',
                'rooms_title' => 'Our Premium Rooms',

                'room1_name' => 'Royal Suite',
                'room1_type' => 'Presidential Suite',
                'room1_text' => 'The pinnacle of luxury with separate living area, dining room, private bar, and panoramic Lagos views. Perfect for VIP guests and special occasions.',
                'room1_price' => 'book from ₦250,000',
                'room1_stars' => '5',

                'room2_name' => 'Executive Suite',
                'room2_type' => 'Business Suite',
                'room2_text' => 'Spacious suite with work desk, meeting area, and premium amenities. Ideal for business executives seeking comfort and productivity.',
                'room2_price' => 'book from ₦150,000',
                'room2_stars' => '5',

                'room3_name' => 'Deluxe Room',
                'room3_type' => 'Superior Room',
                'room3_text' => 'Elegantly appointed room with modern amenities, comfortable bedding, and city views. Perfect for couples and solo travelers.',
                'room3_price' => 'book from ₦85,000',
                'room3_stars' => '4',

                'room4_name' => 'Standard Room',
                'room4_type' => 'Classic Room',
                'room4_text' => 'Comfortable and well-equipped room offering excellent value. Features all essential amenities for a pleasant stay.',
                'room4_price' => 'book from ₦55,000',
                'room4_stars' => '4',

                // Quotes/Testimonials
                'quote1_text' => 'The service at Kuwait Cabin Hotel Bar exceeded all my expectations. From check-in to checkout, every staff member made me feel like royalty. I\'ll definitely return!',
                'quote1_author' => 'Chief Emeka Okonkwo, Lagos',

                'quote2_text' => 'As a frequent business traveler, I\'ve stayed at many hotels in Lagos. Kuwait Cabin stands out for its attention to detail, excellent restaurant, and professional staff.',
                'quote2_author' => 'Dr. Amina Ibrahim, Abuja',

                'quote3_text' => 'We celebrated our anniversary at Kuwait Cabin Hotel Bar and it was magical. The room was beautiful, the food was exceptional, and the atmosphere was perfect.',
                'quote3_author' => 'Mr. & Mrs. Adeyemi, Port Harcourt',

                // Video Section
                'video_title' => 'Discover Our Story',
                'video_subtitle' => 'virtual tour, 2:30 min',

                // Restaurants Section
                'restaurants_subtitle' => 'fine dining',
                'restaurants_title' => 'Culinary Excellence',

                'restaurant1_title' => 'The Cabin Restaurant',
                'restaurant1_text' => 'Experience culinary artistry at The Cabin Restaurant. Our expert chefs blend Nigerian flavors with international techniques to create unforgettable dishes using the freshest local ingredients.',
                'restaurant1_button' => 'view menu',

                'restaurant2_title' => 'Skyline Bar & Lounge',
                'restaurant2_text' => 'Unwind at our rooftop Skyline Bar with craft cocktails, premium spirits, and stunning Lagos skyline views. Live entertainment on weekends creates the perfect atmosphere.',
                'restaurant2_button' => 'explore bar',
            ],
        ]);
    }

    private function populateAboutPageSettings(): void
    {
        $this->command->info('Populating About Page Settings...');

        AboutPageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'About Us - Kuwait Cabin Hotel Bar | Our Story',
            'seo_description' => 'Learn about Kuwait Cabin Hotel Bar\'s commitment to excellence in hospitality. Discover our story, values, and dedication to providing exceptional guest experiences in Lagos.',
            'sections' => [
                'hero' => ['visible' => true],
                'video_presentation' => ['visible' => true],
                'about_services' => ['visible' => true],
                'about_features_pair' => ['visible' => true],
                'about_quotes' => ['visible' => true],
                'about_services_grid' => ['visible' => true],
            ],
            'content' => [
                'hero_title' => 'Our Story',
                'video_subtitle' => 'A Legacy of Excellence',
                'video_duration' => 'our story, 3:15 min',
                'about_services_subtitle' => 'why choose us',
                'about_services_title' => 'Exceptional Hospitality',
                'service1_title' => 'Welcome Experience',
                'service1_text' => 'From the moment you arrive, our dedicated team ensures a warm Nigerian welcome. Complimentary drinks, swift check-in, and personalized attention set the tone for your stay.',
                'service2_title' => 'Premium Facilities',
                'service2_text' => 'Our world-class swimming pool, state-of-the-art gym, and luxurious spa services provide everything you need for relaxation and rejuvenation during your stay.',
                'service3_title' => 'Culinary Excellence',
                'service3_text' => 'Our restaurants serve a fusion of Nigerian delicacies and international cuisine. All meals are prepared with fresh, locally-sourced ingredients by our award-winning chefs.',
                'feature1_label' => 'luxury suites',
                'feature1_title' => 'Uncompromising Comfort',
                'feature1_text' => 'Every room at Kuwait Cabin Hotel Bar is designed with your comfort in mind. From premium bedding to modern technology, we\'ve thoughtfully curated every detail.',
                'feature2_label' => 'world-class service',
                'feature2_title' => 'Service Excellence',
                'feature2_text' => 'Our professionally trained staff are available 24/7 to cater to your every need. Whether it\'s arranging transportation, making restaurant reservations, or fulfilling special requests, we go above and beyond.',
                'quote1_text' => 'Kuwait Cabin Hotel Bar represents the best of Nigerian hospitality. The staff\'s attention to detail and genuine warmth made my business trip feel like a vacation.',
                'quote1_author' => 'Ambassador James Oluwole',
                'quote2_text' => 'I\'ve been coming here for years and the consistency in quality is remarkable. The rooms are always immaculate, and the food never disappoints.',
                'quote2_author' => 'Senator Patricia Nwosu',
                'quote3_text' => 'For our corporate events, we choose Kuwait Cabin without hesitation. Their event planning team is exceptional, and the facilities are world-class.',
                'quote3_author' => 'CEO Michael Okafor, TechVentures Nigeria',
            ],
        ]);
    }

    private function populateContactPageSettings(): void
    {
        $this->command->info('Populating Contact Page Settings...');

        ContactPageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'Contact Us - Kuwait Cabin Hotel Bar Lagos',
            'seo_description' => 'Get in touch with Kuwait Cabin Hotel Bar. Contact us for reservations, inquiries, or to plan your perfect stay in Lagos, Nigeria.',
            'sections' => [
                'hero' => ['visible' => true],
                'video' => ['visible' => true],
                'contact_form' => ['visible' => true],
                'contact_info' => ['visible' => true],
                'newsletter' => ['visible' => true],
            ],
            'content' => [
                'hero_title' => 'Contact Us',
                'video_tagline' => 'We\'re Here to Help',
                'video_label' => 'contact overview, 1:30 min',
                'form_subtitle' => 'reach out to us',
                'form_title' => 'Send Us a Message',
                'info_address' => '15 Victoria Island, Lagos, Nigeria',
                'info_city' => 'Lagos',
                'info_phone' => '+234 812 345 6789',
                'info_email' => 'reservations@kuwaitcabinhotel.com',
                'info_checkin' => '2:00 PM',
                'info_checkout' => '12:00 PM',
                'info_hours' => '24 Hours Daily',
                'newsletter_button' => 'subscribe now',
            ],
        ]);
    }

    private function populateServicesPageSettings(): void
    {
        $this->command->info('Populating Services Page Settings...');

        ServicesPageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'Our Services - Kuwait Cabin Hotel Bar',
            'seo_description' => 'Discover the premium services at Kuwait Cabin Hotel Bar including spa, restaurant, pool, fitness center, and more.',
            'sections' => [
                'hero' => ['visible' => true],
                'video' => ['visible' => true],
                'services_boxes' => ['visible' => true],
                'amenities' => ['visible' => true],
                'offers' => ['visible' => true],
            ],
            'content' => [
                'hero_title' => 'Our Services',
                'video_tagline' => 'Excellence in Every Detail',
                'video_label' => 'services overview, 2:00 min',
                'services_subtitle' => 'premium offerings',
                'services_title' => 'World-Class Amenities',
                'box1_title' => 'Smoke-Free Environment',
                'box1_description' => 'Breathe easy in our completely smoke-free rooms and common areas. We maintain the highest air quality standards.',
                'box2_title' => 'Luxury Bedding',
                'box2_description' => 'Sink into our premium king-sized beds featuring 400-thread count Egyptian cotton sheets and plush duvets.',
                'box3_title' => 'Airport Transfers',
                'box3_description' => 'Enjoy complimentary luxury airport transfers. Our professional drivers track your flight and ensure punctual service.',
                'box4_title' => 'Welcome Refreshments',
                'box4_description' => 'Begin your stay with our signature welcome drink service. Choose from fresh tropical juices or expertly crafted cocktails.',
                'box5_title' => 'Rooftop Pool',
                'box5_description' => 'Our stunning rooftop infinity pool offers breathtaking Lagos skyline views. Enjoy poolside service and comfortable loungers.',
                'box6_title' => 'Gourmet Dining',
                'box6_description' => 'Savor culinary excellence at our on-site restaurants. From traditional Nigerian dishes to international cuisine.',
                'offers_subtitle' => 'exclusive services',
                'offers_title' => 'What We Offer',
                'offer1_title' => 'Spa & Wellness Center',
                'offer1_description' => 'Rejuvenate your body and mind at our full-service spa. Enjoy professional massages, facials, and aromatherapy sessions.',
                'offer2_title' => 'The Cabin Restaurant',
                'offer2_description' => 'Our flagship restaurant serves breakfast, lunch, and dinner daily with a blend of Nigerian and continental cuisine.',
                'offer3_title' => 'Swimming Pool & Deck',
                'offer3_description' => 'Our rooftop pool area features a heated infinity pool, private cabanas, and a poolside bar with stunning city views.',
                'offer4_title' => 'Fitness & Recreation',
                'offer4_description' => 'Stay active in our fully-equipped fitness center featuring modern cardio machines, free weights, and personal training.',
            ],
        ]);
    }

    private function populateRestaurantPageSettings(): void
    {
        $this->command->info('Populating Restaurant Page Settings...');

        RestaurantPageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'Restaurant & Dining - Kuwait Cabin Hotel Bar',
            'seo_description' => 'Enjoy exceptional dining at Kuwait Cabin Hotel Bar. Our restaurants serve authentic Nigerian cuisine and international dishes prepared by expert chefs.',
            'sections' => [
                'hero' => ['visible' => true],
                'video' => ['visible' => true],
                'features' => ['visible' => true],
                'menu' => ['visible' => true],
                'booking' => ['visible' => true],
            ],
            'content' => [
                'hero_title' => 'Restaurant',
                'video_tagline' => 'Culinary Excellence Awaits',
                'menu_subtitle' => 'our specialties',
                'menu_title' => 'Featured Menu',
            ],
        ]);
    }

    private function populateRoomsPageSettings(): void
    {
        $this->command->info('Populating Rooms Page Settings...');

        RoomsPageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'Rooms & Suites - Kuwait Cabin Hotel Bar',
            'seo_description' => 'Browse our luxurious rooms and suites at Kuwait Cabin Hotel Bar. From standard rooms to presidential suites.',
            'sections' => [
                'hero' => ['visible' => true],
                'booking_form' => ['visible' => true],
                'rooms_list' => ['visible' => true],
            ],
            'content' => [
                'hero_title' => 'Our Rooms',
            ],
        ]);
    }

    private function populateExplorePageSettings(): void
    {
        $this->command->info('Populating Explore Page Settings...');

        ExplorePageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'Explore Lagos - Kuwait Cabin Hotel Bar',
            'seo_description' => 'Discover the best of Lagos from Kuwait Cabin Hotel Bar. Explore nearby attractions, beaches, shopping centers.',
            'sections' => [
                'hero' => ['visible' => true],
                'intro' => ['visible' => true],
                'features' => ['visible' => true],
                'rooms' => ['visible' => true],
            ],
            'content' => [
                'hero_title' => 'Explore Lagos',
                'intro_text' => 'Lagos is a vibrant metropolis that never sleeps. From world-class beaches to bustling markets, historic landmarks to modern entertainment venues, there\'s always something exciting to discover. Kuwait Cabin Hotel Bar is perfectly positioned in Victoria Island.',
            ],
        ]);
    }

    private function populateTandcPageSettings(): void
    {
        $this->command->info('Populating Terms & Conditions Page Settings...');

        TandcPageSettings::updateOrCreate(['id' => 1], [
            'seo_title' => 'Terms & Conditions - Kuwait Cabin Hotel Bar',
            'seo_description' => 'Read the terms and conditions for staying at Kuwait Cabin Hotel Bar. Learn about our booking policies.',
            'sections' => [
                'hero' => ['visible' => true],
                'faq' => ['visible' => true],
            ],
            'content' => [
                'hero_title' => 'Terms & Conditions',
                'faq_subtitle' => 'frequently asked questions',
                'faq_title' => 'Hotel Policies',
                'faq_1_question' => 'What is your cancellation policy?',
                'faq_1_answer' => 'Cancellations made 48 hours or more before check-in receive a full refund. Cancellations within 48 hours are charged one night\'s stay. No-shows are charged the full booking amount.',
                'faq_2_question' => 'What are the check-in and check-out times?',
                'faq_2_answer' => 'Standard check-in time is 2:00 PM and check-out time is 12:00 PM (noon). Early check-in and late check-out may be arranged subject to availability.',
                'faq_3_question' => 'What is your refund policy?',
                'faq_3_answer' => 'Refunds for cancellations are processed within 7-10 business days to the original payment method. Prepaid bookings cancelled within policy receive full refunds.',
                'faq_4_question' => 'Do I need to print my booking confirmation?',
                'faq_4_answer' => 'No, simply present your booking confirmation number and a valid government-issued ID at check-in. You can show the confirmation email on your mobile device.',
                'faq_5_question' => 'How do I join your loyalty program?',
                'faq_5_answer' => 'Our Kuwait Cabin Rewards program is free to join. Simply request enrollment at check-in. Members earn points that can be redeemed for free nights and upgrades.',
            ],
        ]);
    }

    private function populateRoomTypes(): void
    {
        $this->command->info('Populating Room Types...');

        // Clear existing room types (optional - comment out if you want to preserve existing)
        // RoomType::truncate();

        $roomTypes = [
            [
                'name' => 'Royal Presidential Suite',
                'subtitle' => 'Presidential Suite',
                'description' => 'Our most luxurious accommodation featuring a spacious living room, private dining area, executive office, master bedroom with king bed, marble bathroom with Jacuzzi, and personal butler service. Includes panoramic Lagos skyline views, complimentary minibar, and exclusive lounge access.',
                'base_price' => 250000.00,
                'max_occupancy' => 4,
                'max_adults' => 2,
                'max_children' => 2,
                'size_sqft' => 1200,
                'stars' => 5,
                'amenities' => ['King Bed', 'Jacuzzi', 'Private Dining', 'Butler Service', 'Lounge Access', 'City Views', 'Free WiFi', 'Mini Bar', 'Room Service'],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Executive Suite',
                'subtitle' => 'Business Suite',
                'description' => 'Perfect for business travelers and those seeking extra space. Features separate living area, work desk with high-speed WiFi, king-sized bed, marble bathroom with rain shower, and stunning city views. Includes breakfast and lounge access.',
                'base_price' => 150000.00,
                'max_occupancy' => 3,
                'max_adults' => 2,
                'max_children' => 1,
                'size_sqft' => 750,
                'stars' => 5,
                'amenities' => ['King Bed', 'Living Room', 'Work Desk', 'Rain Shower', 'Lounge Access', 'Breakfast', 'Free WiFi', 'Mini Bar'],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Deluxe Room',
                'subtitle' => 'Superior Room',
                'description' => 'Elegantly appointed room offering the perfect blend of comfort and style. Features king or twin beds, modern bathroom, flat-screen TV, in-room safe, and city views. Complimentary breakfast included.',
                'base_price' => 85000.00,
                'max_occupancy' => 2,
                'max_adults' => 2,
                'max_children' => 0,
                'size_sqft' => 450,
                'stars' => 4,
                'amenities' => ['King/Twin Beds', 'Flat-screen TV', 'Safe', 'WiFi', 'City Views', 'Breakfast', 'Air Conditioning'],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Standard Room',
                'subtitle' => 'Classic Room',
                'description' => 'Comfortable and well-appointed room perfect for budget-conscious travelers. Features queen bed, en-suite bathroom, TV, air conditioning, and all essential amenities for a pleasant stay.',
                'base_price' => 55000.00,
                'max_occupancy' => 2,
                'max_adults' => 2,
                'max_children' => 0,
                'size_sqft' => 300,
                'stars' => 4,
                'amenities' => ['Queen Bed', 'AC', 'TV', 'WiFi', 'En-suite Bathroom'],
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($roomTypes as $type) {
            RoomType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }

    private function populateRestaurantMenu(): void
    {
        $this->command->info('Populating Restaurant Menu...');

        $menuItems = [
            // Nigerian Cuisine
            ['name' => 'Jollof Rice with Grilled Chicken', 'description' => 'Aromatic rice cooked in rich tomato sauce, served with perfectly grilled chicken', 'category' => 'main_course', 'price' => 4500.00, 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Pounded Yam with Egusi Soup', 'description' => 'Traditional pounded yam served with melon seed soup and assorted meat', 'category' => 'main_course', 'price' => 5200.00, 'is_featured' => true, 'sort_order' => 2],
            ['name' => 'Pepper Soup (Goat Meat)', 'description' => 'Spicy traditional soup with tender goat meat and local spices', 'category' => 'appetizer', 'price' => 4800.00, 'is_spicy' => true, 'sort_order' => 3],
            ['name' => 'Suya Platter', 'description' => 'Assorted grilled beef skewers with spicy peanut coating and fresh onions', 'category' => 'appetizer', 'price' => 6500.00, 'is_spicy' => true, 'is_featured' => true, 'sort_order' => 4],
            ['name' => 'Ofada Rice with Ayamase', 'description' => 'Local rice with designer stew and assorted proteins', 'category' => 'main_course', 'price' => 4200.00, 'sort_order' => 5],

            // Continental Cuisine
            ['name' => 'Grilled Atlantic Salmon', 'description' => 'Fresh salmon fillet with herb butter, seasonal vegetables, and rice', 'category' => 'main_course', 'price' => 12500.00, 'is_featured' => true, 'sort_order' => 6],
            ['name' => 'Beef Tenderloin Steak', 'description' => 'Prime beef cooked to perfection with mushroom sauce and sides', 'category' => 'main_course', 'price' => 15800.00, 'is_featured' => true, 'sort_order' => 7],
            ['name' => 'Caesar Salad', 'description' => 'Crisp romaine lettuce, parmesan, croutons, and house-made dressing', 'category' => 'appetizer', 'price' => 3800.00, 'is_vegetarian' => true, 'sort_order' => 8],
            ['name' => 'Club Sandwich', 'description' => 'Triple-decker with grilled chicken, bacon, lettuce, tomato, and fries', 'category' => 'lunch', 'price' => 4200.00, 'sort_order' => 9],
            ['name' => 'Seafood Pasta', 'description' => 'Linguine with prawns, calamari, mussels in white wine sauce', 'category' => 'main_course', 'price' => 8500.00, 'sort_order' => 10],

            // Desserts
            ['name' => 'Chocolate Lava Cake', 'description' => 'Warm chocolate cake with molten center and vanilla ice cream', 'category' => 'dessert', 'price' => 3200.00, 'is_featured' => true, 'sort_order' => 11],
            ['name' => 'Fresh Fruit Platter', 'description' => 'Selection of seasonal tropical fruits', 'category' => 'dessert', 'price' => 2500.00, 'is_vegan' => true, 'sort_order' => 12],
            ['name' => 'New York Cheesecake', 'description' => 'New York style cheesecake with berry compote', 'category' => 'dessert', 'price' => 2800.00, 'sort_order' => 13],

            // Beverages
            ['name' => 'Fresh Tropical Juice', 'description' => 'Choice of mango, pineapple, watermelon, or orange juice', 'category' => 'beverage', 'price' => 1500.00, 'is_vegan' => true, 'sort_order' => 14],
            ['name' => 'Premium Coffee', 'description' => 'Freshly brewed Arabica coffee', 'category' => 'beverage', 'price' => 1200.00, 'is_vegan' => true, 'sort_order' => 15],
        ];

        foreach ($menuItems as $item) {
            RestaurantMenu::updateOrCreate(
                ['name' => $item['name']],
                array_merge([
                    'is_available' => true,
                    'is_vegetarian' => false,
                    'is_vegan' => false,
                    'is_spicy' => false,
                    'is_featured' => false,
                    'preparation_time' => rand(10, 30),
                ], $item)
            );
        }
    }

    private function populateWebsiteSettings(): void
    {
        $this->command->info('Populating Website Settings...');

        WebsiteSettings::updateOrCreate(['id' => 1], [
            'site_name' => 'Kuwait Cabin Hotel Bar',
            'site_description' => 'Luxury hotel and bar in Victoria Island, Lagos. Experience world-class accommodation, fine dining, and exceptional service.',
            'hero_title' => 'Experience True Luxury',
            'hero_subtitle' => 'Your Home Away From Home',
            'hero_description' => 'Discover unparalleled hospitality at Kuwait Cabin Hotel Bar',
            'phone' => '+234 812 345 6789',
            'email' => 'info@kuwaitcabinhotel.com',
            'address' => '15 Victoria Island, Lagos, Nigeria',
            'facebook_url' => 'https://facebook.com/kuwaitcabinhotel',
            'instagram_url' => 'https://instagram.com/kuwaitcabinhotel',
            'twitter_url' => 'https://twitter.com/kuwaitcabinhotel',
            'meta_description' => 'Kuwait Cabin Hotel Bar - Premier luxury accommodation in Lagos, Nigeria. Book your stay today!',
            'meta_keywords' => 'lagos hotel, victoria island hotel, nigeria luxury hotel, lagos accommodation, kuwait cabin hotel',
        ]);
    }
}
