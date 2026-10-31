<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebsiteSettings;

class WebsiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteSettings::create([
            'site_name' => 'Kuwait Cabin Hotel Bar',
            'site_description' => 'Experience luxury hospitality at its finest with world-class accommodations, exquisite dining, and unparalleled service.',
            'hero_title' => 'Kuwait Cabin Hotel Bar',
            'hero_subtitle' => 'Where Luxury Meets Exceptional Service',
            'hero_description' => 'Experience the pinnacle of hospitality with our world-class accommodations, exquisite dining, and unparalleled service in the heart of the city.',
            'hero_image' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',

            // Black Theme (Default)
            'primary_color' => '#000000',
            'secondary_color' => '#ffffff',
            'accent_color' => '#333333',
            'text_primary' => '#ffffff',
            'text_secondary' => '#cccccc',
            'background_primary' => '#000000',
            'background_secondary' => '#111111',
            'background_tertiary' => '#222222',
            'border_color' => '#333333',

            // Default Fonts
            'font_primary' => 'Arial, sans-serif',
            'font_secondary' => 'Georgia, serif',

            // Contact Info
            'phone' => '+1 (555) 123-4567',
            'email' => 'info@vermonhotel.com',
            'address' => '123 Luxury Avenue, Downtown District, City 12345',

            // Social Media
            'facebook_url' => 'https://facebook.com/vermonhotel',
            'instagram_url' => 'https://instagram.com/vermonhotel',
            'twitter_url' => 'https://twitter.com/vermonhotel',
            'linkedin_url' => 'https://linkedin.com/company/vermonhotel',

            // SEO
            'meta_description' => 'Kuwait Cabin Hotel Bar offers luxury accommodations, fine dining, and exceptional service in the heart of the city. Book your stay today.',
            'meta_keywords' => 'luxury hotel, fine dining, accommodation, hotel booking, business hotel, city center hotel, premium service',
        ]);
    }
}
