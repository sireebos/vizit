<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use App\Models\HomePageSettings;
use App\Models\AboutPageSettings;
use App\Models\RoomsPageSettings;
use App\Models\RestaurantPageSettings;
use App\Models\ContactPageSettings;
use App\Models\ServicesPageSettings;
use App\Models\ExplorePageSettings;
use App\Models\RoomsGalleryPageSettings;
use App\Models\SearchPageSettings;
use App\Models\TandcPageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SiteSettingsController extends Controller
{
    public function edit()
    {
        $settings = SiteSettings::instance();
        return view('admin.site-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SiteSettings::instance();

        // Process header menu - filter out empty items
        $headerMenu = collect($request->input('header_menu', []))
            ->filter(fn($item) => !empty($item['label']))
            ->map(function($item) {
                $item['submenu'] = collect($item['submenu'] ?? [])
                    ->filter(fn($sub) => !empty($sub['label']))
                    ->values()
                    ->toArray();
                return $item;
            })
            ->values()
            ->toArray();

        // Process footer menu - filter out empty items
        $footerMenu = collect($request->input('footer_menu', []))
            ->filter(fn($item) => !empty($item['label']))
            ->values()
            ->toArray();

        $settings->update([
            'site_name' => $request->input('site_name'),
            'site_logo' => $request->input('site_logo'),
            'site_favicon' => $request->input('site_favicon'),
            'currency_symbol' => $request->input('currency_symbol'),
            'currency_code' => $request->input('currency_code'),
            'currency_position' => $request->input('currency_position'),
            'header_phone' => $request->input('header_phone'),
            'header_email' => $request->input('header_email'),
            'header_address' => $request->input('header_address'),
            'header_menu' => json_encode($headerMenu),
            'header_bg_color' => $request->input('header_bg_color'),
            'header_text_color' => $request->input('header_text_color'),
            'footer_subtitle' => $request->input('footer_subtitle'),
            'footer_title' => $request->input('footer_title'),
            'footer_about' => $request->input('footer_about'),
            'footer_phone' => $request->input('footer_phone'),
            'footer_email' => $request->input('footer_email'),
            'footer_address' => $request->input('footer_address'),
            'footer_website' => $request->input('footer_website'),
            'footer_copyright' => $request->input('footer_copyright'),
            'footer_menu' => json_encode($footerMenu),
            'footer_bg_color' => $request->input('footer_bg_color'),
            'footer_text_color' => $request->input('footer_text_color'),
            'footer_heading_color' => $request->input('footer_heading_color'),
            'footer_link_color' => $request->input('footer_link_color'),
            'show_scroll_buttons' => $request->boolean('show_scroll_buttons'),
            'check_in_time' => $request->input('check_in_time'),
            'check_out_time' => $request->input('check_out_time'),
            'opening_hours' => $request->input('opening_hours'),
            'subscribe_button' => $request->input('subscribe_button'),
            // Subscribe Section Styling
            'subscribe_style' => $request->input('subscribe_style', 'classic'),
            'subscribe_title' => $request->input('subscribe_title'),
            'subscribe_subtitle' => $request->input('subscribe_subtitle'),
            'subscribe_placeholder' => $request->input('subscribe_placeholder'),
            'subscribe_input_bg' => $request->input('subscribe_input_bg'),
            'subscribe_input_text' => $request->input('subscribe_input_text'),
            'subscribe_input_border' => $request->input('subscribe_input_border'),
            'subscribe_input_border_radius' => $request->input('subscribe_input_border_radius'),
            'subscribe_btn_bg' => $request->input('subscribe_btn_bg'),
            'subscribe_btn_text' => $request->input('subscribe_btn_text'),
            'subscribe_btn_hover_bg' => $request->input('subscribe_btn_hover_bg'),
            'subscribe_btn_hover_text' => $request->input('subscribe_btn_hover_text'),
            'subscribe_btn_border_radius' => $request->input('subscribe_btn_border_radius'),
            'subscribe_btn_icon' => $request->input('subscribe_btn_icon'),
            'subscribe_btn_icon_only' => $request->boolean('subscribe_btn_icon_only'),
            'subscribe_container_bg' => $request->input('subscribe_container_bg'),
            'subscribe_container_shadow' => $request->input('subscribe_container_shadow'),
            'subscribe_show_section' => $request->boolean('subscribe_show_section'),
            'partner_logo_1' => $request->input('partner_logo_1'),
            'partner_logo_2' => $request->input('partner_logo_2'),
            'partner_logo_3' => $request->input('partner_logo_3'),
            'partner_logo_4' => $request->input('partner_logo_4'),
            'social_facebook' => $request->input('social_facebook'),
            'social_twitter' => $request->input('social_twitter'),
            'social_instagram' => $request->input('social_instagram'),
            'social_youtube' => $request->input('social_youtube'),
            'social_tripadvisor' => $request->input('social_tripadvisor'),
            'notification_email' => $request->input('notification_email'),
            'custom_header_code' => $request->input('custom_header_code'),
            'custom_footer_code' => $request->input('custom_footer_code'),
        ]);

        return redirect()->route('admin.site-settings.edit')->with('status', 'Site settings updated successfully!');
    }

    /**
     * Reset all page settings to defaults (requires password confirmation)
     */
    public function globalReset(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'confirm_reset' => 'required|accepted',
        ]);

        // Verify password
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('admin.site-settings.edit')->with('error', 'Incorrect password. Reset cancelled.');
        }

        // Reset all page settings to defaults
        $pagesReset = [];

        // Home Page
        $homePage = HomePageSettings::first();
        if ($homePage) {
            $homePage->update([
                'sections' => HomePageSettings::defaultSections(),
                'section_order' => HomePageSettings::sectionKeys(),
                'page_styles' => HomePageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Home';
        }

        // About Page
        $aboutPage = AboutPageSettings::first();
        if ($aboutPage) {
            $aboutPage->update([
                'sections' => AboutPageSettings::defaultSections(),
                'section_order' => AboutPageSettings::sectionKeys(),
                'page_styles' => AboutPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'About';
        }

        // Rooms Page
        $roomsPage = RoomsPageSettings::first();
        if ($roomsPage) {
            $roomsPage->update([
                'sections' => RoomsPageSettings::defaultSections(),
                'section_order' => RoomsPageSettings::sectionKeys(),
                'page_styles' => RoomsPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Rooms';
        }

        // Restaurant Page
        $restaurantPage = RestaurantPageSettings::first();
        if ($restaurantPage) {
            $restaurantPage->update([
                'sections' => RestaurantPageSettings::defaultSections(),
                'section_order' => RestaurantPageSettings::sectionKeys(),
                'page_styles' => RestaurantPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Restaurant';
        }

        // Contact Page
        $contactPage = ContactPageSettings::first();
        if ($contactPage) {
            $contactPage->update([
                'sections' => ContactPageSettings::defaultSections(),
                'section_order' => ContactPageSettings::sectionKeys(),
                'page_styles' => ContactPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Contact';
        }

        // Services Page
        $servicesPage = ServicesPageSettings::first();
        if ($servicesPage) {
            $servicesPage->update([
                'sections' => ServicesPageSettings::defaultSections(),
                'section_order' => ServicesPageSettings::sectionKeys(),
                'page_styles' => ServicesPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Services';
        }

        // Explore Page
        $explorePage = ExplorePageSettings::first();
        if ($explorePage) {
            $explorePage->update([
                'sections' => ExplorePageSettings::defaultSections(),
                'section_order' => ExplorePageSettings::sectionKeys(),
                'page_styles' => ExplorePageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Explore';
        }

        // Gallery Page
        $galleryPage = RoomsGalleryPageSettings::first();
        if ($galleryPage) {
            $galleryPage->update([
                'sections' => RoomsGalleryPageSettings::defaultSections(),
                'section_order' => RoomsGalleryPageSettings::sectionKeys(),
                'page_styles' => RoomsGalleryPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Gallery';
        }

        // Search Page
        $searchPage = SearchPageSettings::first();
        if ($searchPage) {
            $searchPage->update([
                'sections' => SearchPageSettings::defaultSections(),
                'section_order' => SearchPageSettings::sectionKeys(),
                'page_styles' => SearchPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Search';
        }

        // Terms & Conditions Page
        $tandcPage = TandcPageSettings::first();
        if ($tandcPage) {
            $tandcPage->update([
                'sections' => TandcPageSettings::defaultSections(),
                'section_order' => TandcPageSettings::sectionKeys(),
                'page_styles' => TandcPageSettings::defaultPageStyles(),
            ]);
            $pagesReset[] = 'Terms & Conditions';
        }

        $message = 'Successfully reset ' . count($pagesReset) . ' pages to defaults: ' . implode(', ', $pagesReset);
        return redirect()->route('admin.site-settings.edit')->with('status', $message);
    }
}

