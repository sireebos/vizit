<?php
/**
 * Update All Pages with Vizit Hotel Content
 * Run: php update_all_pages.php
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\HomePageSettings;
use App\Models\AboutPageSettings;
use App\Models\ServicesPageSettings;

echo "Updating all pages with Vizit Hotel content...\n\n";

// ===== HOME PAGE =====
echo "1. Updating Home Page...\n";
$home = HomePageSettings::firstOrCreate(['id' => 1]);
$content = $home->content ?? [];

// Quotes Section
$content['quotes_count'] = 3;
$content['quote1_text'] = "The service at Vizit Hotel & Suites exceeded all my expectations. From check-in to checkout, every staff member made me feel like royalty. I'll definitely return!";
$content['quote1_author'] = 'Chief Emeka Okonkwo, Lagos';
$content['quote2_text'] = "As a frequent business traveler, I've stayed at many hotels in Benin city. Vizit Hotel & suites stands out for its attention to detail, excellent restaurant, and professional staff.";
$content['quote2_author'] = 'Dr. Amina Ibrahim, Abuja';
$content['quote3_text'] = "We celebrated our anniversary at Vizit Hotel & Suites and it was magical. The room was beautiful, the food was exceptional, and the atmosphere was perfect.";
$content['quote3_author'] = 'Mr. & Mrs. Adeyemi, Port Harcourt';

// Video Section
$content['video_title'] = 'Discover Our Story';
$content['video_subtitle'] = 'virtual tour, 2:30 min';

// Restaurants Section
$content['restaurants_count'] = 2;
$content['restaurants_subtitle'] = 'fine dining';
$content['restaurants_title'] = 'Culinary Excellence';
$content['restaurant1_title'] = 'The Vizit Restaurant';
$content['restaurant1_text'] = 'Experience culinary artistry at The Vizit Restaurant. Our expert chefs blend Nigerian flavors with international techniques to create unforgettable dishes using the freshest local ingredients.';
$content['restaurant1_button'] = 'view menu';
$content['restaurant1_link'] = '/restaurant';
$content['restaurant2_title'] = 'Rooftop Sit-out';
$content['restaurant2_text'] = 'Unwind at our Rooftop Sit-out with stunning views.';
$content['restaurant2_button'] = 'Rooftop Sit-out';
$content['restaurant2_link'] = '/restaurant';

$home->content = $content;
$home->save();
echo "   - Home Page quotes (3), video section, and restaurants (2) updated!\n";

// ===== ABOUT PAGE =====
echo "\n2. Updating About Page...\n";
$about = AboutPageSettings::firstOrCreate(['id' => 1]);
$existingContent = $about->content;
$aboutContent = is_array($existingContent) ? $existingContent : [];

// SEO
$about->seo_title = 'About Us - Vizit Hotel & Suites | Our Story';
$about->seo_description = 'Learn about Vizit Hotel & Suites commitment to excellence in hospitality. Discover our story, values, and dedication to providing exceptional guest experiences in Benin city.';

// Hero
$aboutContent['hero_title'] = 'Our Story';

// Video Presentation
$aboutContent['video_subtitle'] = 'A Legacy of Excellence';
$aboutContent['video_duration'] = 'our story, 3:15 min';

// About Services Section
$aboutContent['about_services_count'] = 3;
$aboutContent['about_services_subtitle'] = 'why choose us';
$aboutContent['about_services_title'] = 'Exceptional Hospitality';

$aboutContent['about_service1_title'] = 'Welcome Experience';
$aboutContent['about_service1_text'] = 'From the moment you arrive, our dedicated team ensures a warm Nigerian welcome. Complimentary drinks, swift check-in, and personalized attention set the tone for your stay.';
$aboutContent['about_service1_button'] = 'read more';
$aboutContent['about_service1_link'] = '/services';

$aboutContent['about_service2_title'] = 'Premium Facilities';
$aboutContent['about_service2_text'] = 'Our world-class swimming pool provide everything you need for relaxation and rejuvenation during your stay.';
$aboutContent['about_service2_button'] = 'read more';
$aboutContent['about_service2_link'] = '/services';

$aboutContent['about_service3_title'] = 'Culinary Excellence';
$aboutContent['about_service3_text'] = 'Our restaurants serve a fusion of Nigerian delicacies and international cuisine. All meals are prepared with fresh, locally-sourced ingredients by our award-winning chefs.';
$aboutContent['about_service3_button'] = 'read more';
$aboutContent['about_service3_link'] = '/restaurant';

// Services Grid
$aboutContent['about_grid_services_count'] = 3;
$aboutContent['about_grid_service1_title'] = 'Restaurant';
$aboutContent['about_grid_service1_link'] = '/restaurant';
$aboutContent['about_grid_service2_title'] = 'Swimming Pool';
$aboutContent['about_grid_service2_link'] = '/services';
$aboutContent['about_grid_service3_title'] = 'Bar & Lounge';
$aboutContent['about_grid_service3_link'] = '/services';

// Features Pair
$aboutContent['about_feature1_label'] = 'from ₦85,000';
$aboutContent['about_feature1_title'] = 'Rosewood Suite';
$aboutContent['about_feature1_text'] = "The pinnacle of luxury with separate living area / meeting area, featuring a premium bedding and stunning city views, memory foam mattresses, and luxury pillows for the ultimate sleep experience.";
$aboutContent['about_feature1_button'] = 'check availability';
$aboutContent['about_feature1_link'] = '/search';

$aboutContent['about_feature2_label'] = 'from ₦128,000';
$aboutContent['about_feature2_title'] = 'The Monarch';
$aboutContent['about_feature2_text'] = "The Perfect comfort for family featuring double bed, Nice views. Perfect for Family getaway and special occasions.";
$aboutContent['about_feature2_button'] = 'check availability';
$aboutContent['about_feature2_link'] = '/search';

// About Quotes
$aboutContent['about_quotes_count'] = 2;
$aboutContent['about_quote1_text'] = "Vizit Hotel & Suites represents the best of Nigerian hospitality. The staff's attention to detail and genuine warmth made my business trip feel like a vacation.";
$aboutContent['about_quote1_author'] = 'Ambassador James Oluwole';
$aboutContent['about_quote2_text'] = "I've been coming here for years and the consistency in quality is remarkable. The rooms are always immaculate, and the food never disappoints. Highly recommended!";
$aboutContent['about_quote2_author'] = 'Senator Patricia Nwosu';

$about->content = $aboutContent;
$about->save();
echo "   - About Page services (3), features pair, and quotes (2) updated!\n";

// ===== SERVICES PAGE =====
echo "\n3. Updating Services Page...\n";
$services = ServicesPageSettings::firstOrCreate(['id' => 1]);
$existingServicesContent = $services->content;
$servicesContent = is_array($existingServicesContent) ? $existingServicesContent : [];

// SEO
$services->seo_title = 'Our Services - Vizit hotel & suites';
$services->seo_description = 'Discover the premium services at Vizit hotel & suites including mini mart, restaurant, pool, Bar and more. Experience luxury hospitality in Benin city.';

// Hero
$servicesContent['hero_title'] = 'Our Services';

// Video
$servicesContent['video_tagline'] = 'Excellence in Every Detail';
$servicesContent['video_label'] = 'services overview, 2:00 min';

// Services Boxes
$servicesContent['boxes_count'] = 5;
$servicesContent['services_subtitle'] = 'premium offerings';
$servicesContent['services_title'] = 'World-Class Amenities';

$servicesContent['box1_title'] = 'Smoke-Free Environment';
$servicesContent['box1_description'] = 'Breathe easy in our completely smoke-free rooms and common areas. We maintain the highest air quality standards for your health and comfort. Designated outdoor smoking areas available.';
$servicesContent['box1_button'] = 'read more';

$servicesContent['box2_title'] = 'Luxury Bedding';
$servicesContent['box2_description'] = "Sink into our premium king-sized beds featuring 400-thread count cotton sheets, plush duvets, and a pillow menu to customize your perfect night's sleep.";
$servicesContent['box2_button'] = 'read more';

$servicesContent['box3_title'] = 'Airport Transfers';
$servicesContent['box3_description'] = 'Enjoy complimentary luxury airport transfers in our air-conditioned vehicles. Our professional drivers track your flight and ensure punctual pickup and drop-off services.';
$servicesContent['box3_button'] = 'read more';

$servicesContent['box4_title'] = 'Welcome Refreshments';
$servicesContent['box4_description'] = 'Begin your stay with our signature welcome drink service. Choose from fresh tropical juices, premium wines, or expertly crafted cocktails upon arrival.';
$servicesContent['box4_button'] = 'read more';

$servicesContent['box5_title'] = 'Rooftop sit-out';
$servicesContent['box5_description'] = 'Our stunning rooftop sit-out offers breathtaking views.';
$servicesContent['box5_button'] = 'read more';

// Service Offers
$servicesContent['offers_count'] = 2;
$servicesContent['offers_subtitle'] = 'exclusive services';
$servicesContent['offers_title'] = 'What We Offer';

$servicesContent['service1_title'] = 'The Vizit Restaurant';
$servicesContent['service1_description'] = 'Our flagship restaurant serves breakfast, lunch, and dinner daily. Experience a blend of Nigerian and continental cuisine prepared with the freshest ingredients by our culinary team.';
$servicesContent['service1_button'] = 'explore';

$servicesContent['service2_title'] = 'Swimming Pool';
$servicesContent['service2_description'] = 'Our pool area Perfect for relaxation or hosting intimate gatherings.';
$servicesContent['service2_button'] = 'explore';

$services->content = $servicesContent;
$services->save();
echo "   - Services Page boxes (5) and offers (2) updated!\n";

// ===== CONTACT PAGE =====
echo "\n4. Updating Contact Page...\n";
$contact = \App\Models\ContactPageSettings::firstOrCreate(['id' => 1]);
$existingContactContent = $contact->content;
$contactContent = is_array($existingContactContent) ? $existingContactContent : [];

// SEO
$contact->seo_title = 'Contact Us - Vizit Hotel & Suites';
$contact->seo_description = 'Get in touch with Vizit Hotel & Suites. Contact us for reservations, inquiries, or to plan your perfect stay in benin city, edo state Nigeria.';

// Hero
$contactContent['hero_title'] = 'Contact Us';

// Video Section
$contactContent['video_tagline'] = "We're Here to Help";
$contactContent['video_label'] = 'contact overview, 1:30 min';

// Contact Form Section
$contactContent['form_subtitle'] = 'reach out to us';
$contactContent['form_title'] = 'Send Us a Message';

// Contact Info
$contactContent['info_address'] = '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria';
$contactContent['info_city'] = 'Benin city, Edo state';
$contactContent['info_phone'] = '+234 816 325 9205';
$contactContent['info_email'] = 'reservations@Vizithotel&suites.com';
$contactContent['info_check_in'] = '2:00 PM';
$contactContent['info_check_out'] = '12:00 PM';
$contactContent['info_hours'] = '24 Hours Daily';

// Newsletter
$contactContent['newsletter_button'] = 'subscribe now';

$contact->content = $contactContent;
$contact->save();
echo "   - Contact Page hero, video, form, and contact info updated!\n";

// ===== BAR MENU (DRINKS) =====
echo "\n5. Updating Bar Menu (Drinks)...\n";
use App\Models\BarMenu;

$drinks = [
    // Soft Drinks & Juices
    ['name' => 'Water', 'price' => 800, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Fresh Juice', 'price' => 3000, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Amstel Malt', 'price' => 2000, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Malta Guinness', 'price' => 2000, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Hollandia', 'price' => 3500, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Chi-Exotic', 'price' => 3500, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Chi-Active', 'price' => 3500, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Vitamilk', 'price' => 3500, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Foyrous', 'price' => 1000, 'category' => 'soft_drink', 'is_alcoholic' => false],
    ['name' => 'Soda (Coke, Fanta, Sprite)', 'price' => 1000, 'category' => 'soft_drink', 'is_alcoholic' => false],
    
    // Energy Drinks
    ['name' => 'Fearless', 'price' => 1500, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Predator', 'price' => 1500, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Monster', 'price' => 2500, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Power Horse', 'price' => 2500, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Red Bull', 'price' => 2500, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Blue Bullet', 'price' => 2500, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Black Bullet', 'price' => 3000, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Double Black', 'price' => 2500, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Energy drink'],
    ['name' => 'Origin Bitters', 'price' => 3000, 'category' => 'soft_drink', 'is_alcoholic' => false, 'description' => 'Herbal bitters'],
    
    // Beers
    ['name' => 'Heineken (Medium)', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true, 'serving_size' => '330ml'],
    ['name' => 'Heineken (Large)', 'price' => 3000, 'category' => 'beer', 'is_alcoholic' => true, 'serving_size' => '600ml'],
    ['name' => '"33" Export', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Goldberg', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Goldberg Black', 'price' => 3000, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Stout (Medium)', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Smirnoff Ice (Big)', 'price' => 3500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Trophy', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Hero', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Big Williams', 'price' => 3000, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Gulder', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Tiger', 'price' => 2000, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Desperado', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    ['name' => 'Star Radler', 'price' => 2500, 'category' => 'beer', 'is_alcoholic' => true],
    
    // Wines
    ['name' => 'Andre', 'price' => 30000, 'category' => 'wine', 'is_alcoholic' => true, 'description' => 'Sparkling wine'],
    ['name' => 'Martini Rose', 'price' => 30000, 'category' => 'wine', 'is_alcoholic' => true, 'description' => 'Rosé wine'],
    ['name' => 'Baron De Valls', 'price' => 20000, 'category' => 'wine', 'is_alcoholic' => true],
    ['name' => 'Four Cousin', 'price' => 20000, 'category' => 'wine', 'is_alcoholic' => true],
    ['name' => 'Carlo Rossi', 'price' => 20000, 'category' => 'wine', 'is_alcoholic' => true],
    ['name' => 'Friends & Family', 'price' => 20000, 'category' => 'wine', 'is_alcoholic' => true],
    ['name' => 'Agor', 'price' => 20000, 'category' => 'wine', 'is_alcoholic' => true],
    ['name' => 'Drevnii Monah', 'price' => 25000, 'category' => 'wine', 'is_alcoholic' => true],
    
    // Spirits
    ['name' => 'Small Best Cream', 'price' => 5000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Cream liqueur'],
    ['name' => 'Small William Lawson', 'price' => 10000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Scotch whisky'],
    ['name' => 'Big William Lawson', 'price' => 35000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Scotch whisky'],
    ['name' => 'Small Campari', 'price' => 12000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Italian aperitif'],
    ['name' => 'Big Campari', 'price' => 45000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Italian aperitif'],
    ['name' => 'Omelca Tequila', 'price' => 55000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Premium tequila'],
    ['name' => 'Small Smirnoff Vodka', 'price' => 5000, 'category' => 'spirits', 'is_alcoholic' => true],
    ['name' => 'Big Smirnoff Vodka', 'price' => 15000, 'category' => 'spirits', 'is_alcoholic' => true],
    ['name' => 'Jagermeister', 'price' => 30000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'German herbal liqueur'],
    ['name' => 'Jameson Green', 'price' => 45000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Irish whiskey'],
    ['name' => 'Jameson Black', 'price' => 75000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Irish whiskey - Premium'],
    ['name' => 'Black Label', 'price' => 75000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Johnnie Walker Scotch whisky'],
    ['name' => 'Martell VS', 'price' => 120000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Cognac'],
    ['name' => 'Martell Blue Swift', 'price' => 170000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Cognac - Premium'],
    ['name' => 'Hennessey VS', 'price' => 80000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Cognac'],
    ['name' => 'Hennessey VSOP', 'price' => 160000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Cognac - Premium'],
    ['name' => 'Glenfiddich 12YRS', 'price' => 130000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Single malt Scotch whisky - 12 Years'],
    ['name' => 'Glenfiddich 15YRS', 'price' => 160000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Single malt Scotch whisky - 15 Years'],
    ['name' => 'Glenfiddich 18YRS', 'price' => 250000, 'category' => 'spirits', 'is_alcoholic' => true, 'description' => 'Single malt Scotch whisky - 18 Years'],
    
    // Cocktails & Mocktails
    ['name' => 'Blue Lagoon', 'price' => 6000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Vodka-based cocktail with blue curaçao'],
    ['name' => 'Margarita', 'price' => 8000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Classic tequila cocktail'],
    ['name' => 'Tequila Sunrise', 'price' => 6000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Tequila with orange juice and grenadine'],
    ['name' => 'Pina Colada', 'price' => 8000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Rum with coconut and pineapple'],
    ['name' => 'Screwdriver', 'price' => 6000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Vodka with orange juice'],
    ['name' => 'Blue Haven', 'price' => 8000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Tropical blue cocktail'],
    ['name' => 'Sex on the Beach', 'price' => 8000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Vodka, peach schnapps, orange and cranberry'],
    ['name' => 'Wet Pussy', 'price' => 8000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Sweet layered shot'],
    ['name' => 'Long Island Iced Tea', 'price' => 8000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Mixed spirits cocktail'],
    ['name' => 'Alcoholic Chapman', 'price' => 8000, 'category' => 'cocktail', 'is_alcoholic' => true, 'description' => 'Nigerian cocktail with spirits'],
    ['name' => 'Non-Alcoholic Chapman', 'price' => 5000, 'category' => 'mocktail', 'is_alcoholic' => false, 'description' => 'Classic Nigerian mocktail with Fanta, Sprite, and bitters'],
];

$drinkCount = 0;
foreach ($drinks as $index => $drink) {
    BarMenu::updateOrCreate(
        ['name' => $drink['name']],
        [
            'price' => $drink['price'],
            'category' => $drink['category'],
            'is_alcoholic' => $drink['is_alcoholic'],
            'description' => $drink['description'] ?? null,
            'serving_size' => $drink['serving_size'] ?? null,
            'is_available' => true,
            'sort_order' => $index + 1,
        ]
    );
    $drinkCount++;
}
echo "   - Bar Menu: $drinkCount drinks added/updated!\n";

// ===== FOOD MENU (RESTAURANT) =====
echo "\n6. Updating Food Menu (Restaurant)...\n";
use App\Models\RestaurantMenu;

// Clear existing food menu items
RestaurantMenu::truncate();
echo "   - Cleared existing food menu items\n";

$foods = [
    // Meals (Rice)
    ['name' => 'Jollof Rice', 'price' => 3000, 'category' => 'main_course', 'description' => 'Nigerian classic - tomato-based rice dish'],
    ['name' => 'Fried Rice', 'price' => 3000, 'category' => 'main_course', 'description' => 'Stir-fried rice with vegetables'],
    ['name' => 'White Rice', 'price' => 3000, 'category' => 'main_course', 'description' => 'Plain steamed rice'],
    ['name' => 'Basmati Rice', 'price' => 6000, 'category' => 'main_course', 'description' => 'Premium long-grain aromatic rice'],
    ['name' => 'Coconut Rice', 'price' => 3000, 'category' => 'main_course', 'description' => 'Rice cooked in coconut milk (On Request)'],
    ['name' => 'Special Fried Rice', 'price' => 8000, 'category' => 'main_course', 'description' => 'Premium fried rice with extra toppings (On Request)'],
    ['name' => 'Native Rice', 'price' => 8000, 'category' => 'main_course', 'description' => 'Traditional Nigerian rice dish (On Request)'],
    ['name' => 'Jamaican Rice', 'price' => 6000, 'category' => 'main_course', 'description' => 'Caribbean-style rice (On Request)'],
    ['name' => 'Seafood Jollof', 'price' => 8000, 'category' => 'main_course', 'description' => 'Jollof rice with assorted seafood (On Request)'],
    ['name' => 'Signature Rice', 'price' => 8000, 'category' => 'main_course', 'description' => 'Chef\'s special rice dish (On Request)'],
    
    // Pasta
    ['name' => 'Vegetable Noodles', 'price' => 3000, 'category' => 'main_course', 'description' => 'Stir-fried noodles with vegetables'],
    ['name' => 'Jollof Spaghetti', 'price' => 3000, 'category' => 'main_course', 'description' => 'Nigerian-style spaghetti in tomato sauce'],
    ['name' => 'White Spaghetti', 'price' => 3000, 'category' => 'main_course', 'description' => 'Plain spaghetti with sauce'],
    ['name' => 'Spaghetti Bolognese', 'price' => 6000, 'category' => 'main_course', 'description' => 'Italian pasta with meat sauce'],
    ['name' => 'Stir Fry Pasta', 'price' => 6000, 'category' => 'main_course', 'description' => 'Wok-fried pasta with vegetables'],
    ['name' => 'Alfredo Pasta (Creamy)', 'price' => 6000, 'category' => 'main_course', 'description' => 'Pasta in creamy white sauce (On Request)'],
    ['name' => 'Seafood Pasta', 'price' => 8000, 'category' => 'main_course', 'description' => 'Pasta with assorted seafood (On Request)'],
    ['name' => 'Penne Arabiata', 'price' => 6000, 'category' => 'main_course', 'description' => 'Penne in spicy tomato sauce (On Request)', 'is_spicy' => true],
    
    // Proteins
    ['name' => 'Turkey', 'price' => 8000, 'category' => 'main_course', 'description' => 'Seasoned turkey portion'],
    ['name' => 'Chicken', 'price' => 6000, 'category' => 'main_course', 'description' => 'Well-seasoned chicken portion'],
    ['name' => 'Goat Meat', 'price' => 6000, 'category' => 'main_course', 'description' => 'Tender goat meat portion'],
    ['name' => 'Beef', 'price' => 5000, 'category' => 'main_course', 'description' => 'Premium beef portion'],
    ['name' => 'Snail (One Portion)', 'price' => 10000, 'category' => 'main_course', 'description' => 'Giant African snail delicacy'],
    ['name' => 'Sauced Kpomo', 'price' => 5000, 'category' => 'main_course', 'description' => 'Cow skin in pepper sauce'],
    ['name' => 'Assorted Meat', 'price' => 7000, 'category' => 'main_course', 'description' => 'Mixed meat selection'],
    ['name' => 'Cow Head', 'price' => 6000, 'category' => 'main_course', 'description' => 'Traditional cow head meat'],
    ['name' => 'Meluza Fish', 'price' => 6000, 'category' => 'main_course', 'description' => 'Grilled Meluza fish'],
    ['name' => 'Croaker Fish', 'price' => 9000, 'category' => 'main_course', 'description' => 'Fresh croaker fish'],
    ['name' => 'Titus Fish', 'price' => 8000, 'category' => 'main_course', 'description' => 'Grilled Titus mackerel'],
    ['name' => 'Catfish (Half)', 'price' => 8000, 'category' => 'main_course', 'description' => 'Half portion of catfish'],
    
    // Pepper Soup
    ['name' => 'Chicken Pepper Soup', 'price' => 8000, 'category' => 'appetizer', 'description' => 'Spicy chicken broth', 'is_spicy' => true],
    ['name' => 'Goatmeat Pepper Soup', 'price' => 8000, 'category' => 'appetizer', 'description' => 'Traditional goat meat soup', 'is_spicy' => true],
    ['name' => 'Catfish Pepper Soup (One Portion)', 'price' => 8000, 'category' => 'appetizer', 'description' => 'Single portion catfish soup', 'is_spicy' => true],
    ['name' => 'Catfish Pepper Soup (Full Pot)', 'price' => 15000, 'category' => 'appetizer', 'description' => 'Full pot of catfish soup', 'is_spicy' => true],
    ['name' => 'Ukodo (Full Catfish and Yam)', 'price' => 18000, 'category' => 'appetizer', 'description' => 'Traditional Urhobo yam pepper soup with full catfish', 'is_spicy' => true],
    ['name' => 'Ukodo (Half Catfish and Yam)', 'price' => 11000, 'category' => 'appetizer', 'description' => 'Urhobo yam pepper soup with half catfish', 'is_spicy' => true],
    ['name' => 'Assorted Pepper Soup', 'price' => 7000, 'category' => 'appetizer', 'description' => 'Mixed meat pepper soup', 'is_spicy' => true],
    ['name' => 'Croaker Pepper Soup', 'price' => 10000, 'category' => 'appetizer', 'description' => 'Croaker fish in spicy broth', 'is_spicy' => true],
    
    // Soups
    ['name' => 'Egusi Soup', 'price' => 3000, 'category' => 'main_course', 'description' => 'Melon seed soup - Nigerian classic'],
    ['name' => 'Ogbono Soup', 'price' => 3000, 'category' => 'main_course', 'description' => 'Draw soup made from bush mango seeds'],
    ['name' => 'Banga Soup', 'price' => 3000, 'category' => 'main_course', 'description' => 'Palm fruit soup - Delta specialty'],
    ['name' => 'Black Soup', 'price' => 3000, 'category' => 'main_course', 'description' => 'Traditional black soup'],
    ['name' => 'Vegetable Soup', 'price' => 4000, 'category' => 'main_course', 'description' => 'Fresh vegetable soup', 'is_vegetarian' => true],
    ['name' => 'Okro Soup', 'price' => 4000, 'category' => 'main_course', 'description' => 'Okra-based soup'],
    ['name' => 'Bitterleaf Soup', 'price' => 3000, 'category' => 'main_course', 'description' => 'Igbo traditional bitterleaf soup'],
    ['name' => 'Oha Soup', 'price' => 3000, 'category' => 'main_course', 'description' => 'Igbo soup with oha leaves'],
    ['name' => 'Seafood Okro', 'price' => 15000, 'category' => 'main_course', 'description' => 'Okro soup with assorted seafood (On Request)'],
    ['name' => 'Fisherman Soup', 'price' => 20000, 'category' => 'main_course', 'description' => 'Rich soup with fresh fish and seafood (On Request)'],
    
    // Swallows
    ['name' => 'Poundo', 'price' => 2000, 'category' => 'main_course', 'description' => 'Pounded yam - smooth and stretchy'],
    ['name' => 'Semo', 'price' => 2000, 'category' => 'main_course', 'description' => 'Semolina swallow'],
    ['name' => 'Eba', 'price' => 2000, 'category' => 'main_course', 'description' => 'Garri swallow - cassava-based'],
    ['name' => 'Starch', 'price' => 2000, 'category' => 'main_course', 'description' => 'Cassava starch swallow - Delta specialty'],
    
    // African Dishes
    ['name' => 'Yam Chips/Boiled Yam', 'price' => 3000, 'category' => 'main_course', 'description' => 'Fried or boiled yam'],
    ['name' => 'Fried Plantain/Boiled Plantain', 'price' => 3000, 'category' => 'main_course', 'description' => 'Sweet plantain - fried or boiled'],
    ['name' => 'Fried/Boiled Sweet Potato', 'price' => 3000, 'category' => 'main_course', 'description' => 'Sweet potato preparation'],
    ['name' => 'Boiled Irish Potato', 'price' => 3000, 'category' => 'main_course', 'description' => 'Soft boiled potatoes'],
    ['name' => 'Porridge Yam', 'price' => 3000, 'category' => 'main_course', 'description' => 'Yam cooked in palm oil and spices'],
    ['name' => 'Porridge Beans', 'price' => 3000, 'category' => 'main_course', 'description' => 'Beans cooked in palm oil', 'is_vegetarian' => true],
    ['name' => 'Moi-Moi', 'price' => 2000, 'category' => 'appetizer', 'description' => 'Steamed bean pudding', 'is_vegetarian' => true],
    ['name' => 'Akara', 'price' => 2000, 'category' => 'appetizer', 'description' => 'Deep-fried bean cakes', 'is_vegetarian' => true],
    ['name' => 'Custard', 'price' => 1500, 'category' => 'breakfast', 'description' => 'Creamy custard pudding'],
    ['name' => 'Oat Meal', 'price' => 1500, 'category' => 'breakfast', 'description' => 'Warm oatmeal', 'is_vegetarian' => true],
    ['name' => 'Boiled/Fried Eggs', 'price' => 2000, 'category' => 'breakfast', 'description' => 'Eggs - your choice of style', 'is_vegetarian' => true],
    ['name' => 'Salad', 'price' => 2000, 'category' => 'appetizer', 'description' => 'Fresh vegetable salad', 'is_vegetarian' => true, 'is_vegan' => true],
    
    // Sauces
    ['name' => 'Egg Sauce', 'price' => 2500, 'category' => 'main_course', 'description' => 'Tomato-based sauce with eggs', 'is_vegetarian' => true],
    ['name' => 'Vegetable Sauce', 'price' => 2000, 'category' => 'main_course', 'description' => 'Fresh vegetable sauce', 'is_vegetarian' => true],
    ['name' => 'Tomato Sauce', 'price' => 2000, 'category' => 'main_course', 'description' => 'Rich tomato sauce', 'is_vegetarian' => true],
    ['name' => 'Garden Egg Sauce', 'price' => 2000, 'category' => 'main_course', 'description' => 'African eggplant sauce', 'is_vegetarian' => true],
    ['name' => 'Fish Sauce', 'price' => 2500, 'category' => 'main_course', 'description' => 'Sauce with fish chunks'],
    
    // Intercontinental (Breakfast)
    ['name' => 'Toasted Bread with Tea/Coffee', 'price' => 3000, 'category' => 'breakfast', 'description' => 'Toasted or fresh bread with hot beverage', 'is_vegetarian' => true],
    ['name' => 'Pancakes', 'price' => 2000, 'category' => 'breakfast', 'description' => 'Fluffy pancakes (On Request)', 'is_vegetarian' => true],
    ['name' => 'Waffles', 'price' => 2000, 'category' => 'breakfast', 'description' => 'Crispy waffles (On Request)', 'is_vegetarian' => true],
    ['name' => 'English Breakfast', 'price' => 7000, 'category' => 'breakfast', 'description' => 'Toasted bread, sausage, baked beans, omelette with tea or coffee'],
    ['name' => 'Club Sandwich', 'price' => 4000, 'category' => 'lunch', 'description' => 'Triple-decker sandwich with chicken, bacon, and veggies'],
    ['name' => 'French Fries', 'price' => 3000, 'category' => 'appetizer', 'description' => 'Crispy golden fries', 'is_vegetarian' => true, 'is_vegan' => true],
    
    // Grill Hot Plate
    ['name' => 'Chicken & Chips', 'price' => 9000, 'category' => 'main_course', 'description' => 'Grilled chicken with french fries'],
    ['name' => 'Barbecue Fish (Catfish), Chips & Salad', 'price' => 10000, 'category' => 'main_course', 'description' => 'BBQ catfish with fries and fresh salad'],
    ['name' => 'Barbecue with Bole, Chips & Salad', 'price' => 13000, 'category' => 'main_course', 'description' => 'BBQ meat with roasted plantain, chips and salad'],
    ['name' => 'Isi Ewu (Full Goat Head)', 'price' => 10000, 'category' => 'main_course', 'description' => 'Igbo delicacy - spiced goat head', 'is_spicy' => true],
    ['name' => 'Nkwobi (Cow Head)', 'price' => 10000, 'category' => 'main_course', 'description' => 'Igbo delicacy - spiced cow foot in palm oil', 'is_spicy' => true],
];

$foodCount = 0;
foreach ($foods as $index => $food) {
    RestaurantMenu::create([
        'name' => $food['name'],
        'price' => $food['price'],
        'category' => $food['category'],
        'description' => $food['description'] ?? null,
        'is_vegetarian' => $food['is_vegetarian'] ?? false,
        'is_vegan' => $food['is_vegan'] ?? false,
        'is_spicy' => $food['is_spicy'] ?? false,
        'is_available' => true,
        'sort_order' => $index + 1,
    ]);
    $foodCount++;
}
echo "   - Food Menu: $foodCount items added!\n";

echo "\n========================================\n";
echo "All pages updated successfully!\n";
echo "========================================\n";
echo "\nSummary:\n";
echo "- Home Page: 3 quotes, video section, 2 restaurants\n";
echo "- About Page: 3 services, features pair, 2 quotes\n";
echo "- Services Page: 5 boxes, 2 service offers\n";
echo "- Contact Page: hero, video, form section, contact info\n";
echo "- Bar Menu: $drinkCount drinks (soft drinks, energy drinks, beers, wines, spirits, cocktails)\n";
echo "- Food Menu: $foodCount items (rice, pasta, proteins, soups, swallows, african dishes, grills)\n";

// ===== SEO FOR ALL REMAINING PAGES =====
echo "\n7. Updating SEO for all pages...\n";

// Restaurant Page SEO
$restaurant = \App\Models\RestaurantPageSettings::firstOrCreate(['id' => 1]);
$restaurant->seo_title = 'Restaurant & Dining - Vizit Hotel & Suites';
$restaurant->seo_description = 'Enjoy exceptional dining at Vizit Hotel & Suites. Our restaurants serve authentic Nigerian cuisine and international dishes prepared by expert chefs.';
$restaurantContent = is_array($restaurant->content) ? $restaurant->content : [];
$restaurantContent['hero_title'] = 'Restaurant';
$restaurantContent['video_tagline'] = 'Culinary Excellence Awaits';
$restaurantContent['menu_subtitle'] = 'our specialties';
$restaurantContent['menu_title'] = 'Featured Menu';
$restaurant->content = $restaurantContent;
$restaurant->save();
echo "   - Restaurant Page: SEO + hero + menu section titles\n";

// Rooms Page SEO
$rooms = \App\Models\RoomsPageSettings::firstOrCreate(['id' => 1]);
$rooms->seo_title = 'Our Rooms & Suites - Vizit Hotel & Suites';
$rooms->seo_description = 'Discover our luxurious rooms and suites at Vizit Hotel & Suites. From Pearl Rooms to The Monarch Suite, find your perfect accommodation in Benin City.';
$roomsContent = is_array($rooms->content) ? $rooms->content : [];
$roomsContent['hero_title'] = 'Our Rooms';
$roomsContent['hero_subtitle'] = 'Luxury Accommodation';
$rooms->content = $roomsContent;
$rooms->save();
echo "   - Rooms Page: SEO + hero titles\n";

// Rooms Gallery Page SEO
$roomsGallery = \App\Models\RoomsGalleryPageSettings::firstOrCreate(['id' => 1]);
$roomsGallery->seo_title = 'Room Gallery - Vizit Hotel & Suites';
$roomsGallery->seo_description = 'View our stunning room gallery. See the luxury interiors, premium amenities, and elegant design of our rooms and suites at Vizit Hotel & Suites.';
$roomsGallery->save();
echo "   - Rooms Gallery Page: SEO updated\n";

// Gallery/Explore Page SEO  
$explore = \App\Models\ExplorePageSettings::firstOrCreate(['id' => 1]);
$explore->seo_title = 'Gallery - Vizit Hotel & Suites';
$explore->seo_description = "View photos of Vizit Hotel & Suites including our spacious rooms, restaurant, pool, bar, and facilities. See why we're Benin's premier hotel.";
$exploreContent = is_array($explore->content) ? $explore->content : [];
$exploreContent['hero_title'] = 'Our Gallery';
$explore->content = $exploreContent;
$explore->save();
echo "   - Explore/Gallery Page: SEO + hero title\n";

// Search Page SEO
$search = \App\Models\SearchPageSettings::firstOrCreate(['id' => 1]);
$search->seo_title = 'Book Your Stay - Vizit Hotel & Suites';
$search->seo_description = 'Search and book available rooms at Vizit Hotel & Suites. Find the perfect accommodation for your stay in Benin City, Nigeria.';
$searchContent = is_array($search->content) ? $search->content : [];
$searchContent['hero_title'] = 'Find Your Perfect Room';
$searchContent['hero_subtitle'] = 'Search Availability';
$search->content = $searchContent;
$search->save();
echo "   - Search Page: SEO + hero titles\n";

// Terms & Conditions Page SEO
$tandc = \App\Models\TandcPageSettings::firstOrCreate(['id' => 1]);
$tandc->seo_title = 'Terms & Conditions - Vizit Hotel & Suites';
$tandc->seo_description = 'Read the terms and conditions for booking at Vizit Hotel & Suites. Learn about check-in/check-out times, cancellation policy, and hotel rules.';
$tandcContent = is_array($tandc->content) ? $tandc->content : [];
$tandcContent['hero_title'] = 'Terms & Conditions';
$tandcContent['terms_content'] = "
<h3>Booking & Rates</h3>
<ul>
<li>All prices include breakfast for 1 person and free swimming</li>
<li>Payment in full or a valid credit card guarantees the booking</li>
<li>Maximum occupancy per room is two (2) persons. Exceeding this limit is not permitted.</li>
</ul>

<h3>Check-In & Check-Out</h3>
<ul>
<li>Check-in time is 2:00 PM</li>
<li>Check-out time is 12:00 Noon</li>
<li>Early check-in is subject to room availability</li>
</ul>

<h3>Late Check-Out Policy</h3>
<ul>
<li>Before 4:00 PM: 50% of room rate</li>
<li>After 4:00 PM: 100% of room rate</li>
</ul>

<h3>Cancellation Policy</h3>
<ul>
<li>Early check-out will be paid in full</li>
<li>No-show fee will be charged in full for the first night booked</li>
<li>Cancellations made less than 24 hours before arrival will be charged in full</li>
</ul>
";
$tandc->content = $tandcContent;
$tandc->save();
echo "   - Terms & Conditions Page: SEO + content\n";

// Site Settings
$siteSettings = \App\Models\SiteSettings::firstOrCreate(['id' => 1]);
$siteSettings->site_name = 'Vizit Hotel & Suites';
$siteSettings->header_phone = '+234 816 325 9205';
$siteSettings->header_email = 'info@Vizithotel&suites.com';
$siteSettings->header_address = '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria';
$siteSettings->footer_subtitle = 'get in touch';
$siteSettings->footer_title = 'contact us today';
$siteSettings->footer_about = 'Vizit Hotel & Suites offers an exceptional blend of luxury accommodation and vibrant entertainment in the heart of Benin City. Experience Nigerian hospitality at its finest with world-class amenities and personalized service.';
$siteSettings->footer_phone = '+234 816 325 9205';
$siteSettings->footer_email = 'reservations@Vizithotel&suites.com';
$siteSettings->footer_address = '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria';
$siteSettings->footer_copyright = '© 2025 Vizit Hotel & Suites. All rights reserved.';
$siteSettings->check_in_time = '2:00 PM';
$siteSettings->check_out_time = '12:00 PM';
$siteSettings->opening_hours = '24 Hours';
$siteSettings->social_facebook = null; // No Facebook URL provided
$siteSettings->social_twitter = null; // No Twitter URL provided
$siteSettings->social_instagram = 'https://www.instagram.com/vizit_hotelsuites?igsh=MThobnljY3pmcXE1ZQ==';
$siteSettings->social_tiktok = 'https://www.tiktok.com/@vizithotelandsuites?_r=1&_t=ZS-930KienLb4J';
$siteSettings->social_tripadvisor = 'https://www.tripadvisor.com/Hotel_Review-g298361-d33974433-Reviews-Vizit_Hotel_Suites-Benin_City_Edo_State.html';
$siteSettings->social_booking = 'https://www.booking.com/hotel/ng/vizit-amp-suites.html';
$siteSettings->notification_email = 'admin@Vizithotel&suites.com';
$siteSettings->currency_symbol = '₦';
$siteSettings->currency_code = 'NGN';
// Header & Footer colors (matching Hotel Booking template)
$siteSettings->header_bg_color = '#1a2a3a';      // Dark Navy header
$siteSettings->header_text_color = '#ffffff';    // White text
$siteSettings->footer_bg_color = '#1a2a3a';      // Dark Navy footer
$siteSettings->footer_text_color = '#cccccc';    // Light gray text
$siteSettings->footer_heading_color = '#ffffff'; // White headings
$siteSettings->footer_link_color = '#f7c51e';    // Yellow links
$siteSettings->save();
echo "   - Site Settings: name, contact info, footer, social links, header/footer colors\n";

// Theme Settings - Yellow & Navy Hotel Booking Style
$theme = \App\Models\ThemeSettings::first();
if (!$theme) {
    $theme = new \App\Models\ThemeSettings();
}

// Yellow & Navy Color Scheme (Hotel Booking Template Style)
$theme->primary_color = '#f7c51e';      // Bright Yellow - Main brand/CTA color
$theme->secondary_color = '#1a2a3a';    // Dark Navy - Header/Footer background
$theme->accent_color = '#f7c51e';       // Bright Yellow - Accents & highlights
$theme->text_color = '#333333';         // Dark Gray - Body text
$theme->heading_color = '#1a2a3a';      // Dark Navy - Headings
$theme->link_color = '#f7c51e';         // Bright Yellow - Links
$theme->button_color = '#f7c51e';       // Bright Yellow - Buttons
$theme->button_hover_color = '#e0b300'; // Darker Yellow - Button hover
$theme->footer_bg_color = '#1a2a3a';    // Dark Navy - Footer background
$theme->footer_text_color = '#cccccc';  // Light Gray - Footer text
$theme->heading_font = 'Playfair Display'; // Elegant serif for headings
$theme->body_font = 'Poppins';          // Clean sans-serif for body
$theme->header_style = 'dark';          // Dark header style
$theme->sticky_header = true;           // Sticky header enabled
$theme->show_top_bar = true;            // Show top bar
$theme->button_style = 'rounded';       // Rounded buttons
$theme->layout_style = 'wide';          // Wide layout
$theme->save();
echo "   - Theme Settings: Yellow & Navy hotel booking color scheme\n";

echo "\n========================================\n";
echo "SEO COMPLETE FOR ALL PAGES!\n";
echo "========================================\n";
