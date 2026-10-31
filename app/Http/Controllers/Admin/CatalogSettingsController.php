<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogSettings;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class CatalogSettingsController extends Controller
{
    public function edit()
    {
        $catalog = CatalogSettings::instance();
        $siteSettings = SiteSettings::first();
        
        return view('admin.catalog-settings.edit', [
            'catalog' => $catalog,
            'siteSettings' => $siteSettings,
            'displayModes' => CatalogSettings::displayModeOptions(),
            'itemsPerRowOptions' => CatalogSettings::itemsPerRowOptions(),
            'defaultTabOptions' => CatalogSettings::defaultTabOptions(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            // Display Settings
            'display_mode' => 'required|in:grid,list,compact',
            'items_per_row' => 'required|integer|min:2|max:5',
            'show_images' => 'boolean',
            'show_descriptions' => 'boolean',
            'show_prices' => 'boolean',
            'show_featured_badge' => 'boolean',
            'show_item_count' => 'boolean',
            
            // Default Tab
            'default_tab' => 'required|in:drinks,food,rooms',
            
            // Section Visibility
            'show_drinks_section' => 'boolean',
            'show_food_section' => 'boolean',
            'show_rooms_section' => 'boolean',
            'show_qrcode_tab' => 'boolean',
            
            // Header Settings
            'tagline' => 'nullable|string|max:500',
            'show_contact_bar' => 'boolean',
            'show_phone' => 'boolean',
            'show_email' => 'boolean',
            'show_address' => 'boolean',
            'show_website' => 'boolean',
            
            // Color Settings
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'card_bg_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'muted_text_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'price_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            
            // Footer Settings
            'show_footer' => 'boolean',
            'show_back_button' => 'boolean',
            
            // Custom CSS
            'custom_css' => 'nullable|string|max:10000',
        ]);

        // Handle checkbox fields
        $booleanFields = [
            'show_images', 'show_descriptions', 'show_prices', 'show_featured_badge',
            'show_item_count', 'show_drinks_section', 'show_food_section', 'show_rooms_section',
            'show_qrcode_tab', 'show_contact_bar', 'show_phone', 'show_email', 'show_address',
            'show_website', 'show_footer', 'show_back_button'
        ];

        foreach ($booleanFields as $field) {
            $validated[$field] = $request->has($field);
        }

        $catalog = CatalogSettings::instance();
        $catalog->update($validated);

        return redirect()->route('admin.catalog-settings.edit')
            ->with('success', 'Catalog settings updated successfully!');
    }

    public function reset()
    {
        $catalog = CatalogSettings::instance();
        $catalog->resetToDefaults();

        return redirect()->route('admin.catalog-settings.edit')
            ->with('success', 'Catalog settings reset to defaults!');
    }
}
