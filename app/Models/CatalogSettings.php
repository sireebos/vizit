<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogSettings extends Model
{
    protected $table = 'catalog_settings';

    protected $fillable = [
        // Display Settings
        'display_mode',
        'items_per_row',
        'show_images',
        'show_descriptions',
        'show_prices',
        'show_featured_badge',
        'show_item_count',
        
        // Default Tab
        'default_tab',
        
        // Section Visibility
        'show_drinks_section',
        'show_food_section',
        'show_rooms_section',
        'show_qrcode_tab',
        
        // Header Settings
        'tagline',
        'show_contact_bar',
        'show_phone',
        'show_email',
        'show_address',
        'show_website',
        
        // Color Settings
        'primary_color',
        'background_color',
        'card_bg_color',
        'text_color',
        'muted_text_color',
        'price_color',
        
        // Footer Settings
        'show_footer',
        'show_back_button',
        
        // Custom CSS
        'custom_css',
    ];

    protected $casts = [
        'show_images' => 'boolean',
        'show_descriptions' => 'boolean',
        'show_prices' => 'boolean',
        'show_featured_badge' => 'boolean',
        'show_item_count' => 'boolean',
        'show_drinks_section' => 'boolean',
        'show_food_section' => 'boolean',
        'show_rooms_section' => 'boolean',
        'show_qrcode_tab' => 'boolean',
        'show_contact_bar' => 'boolean',
        'show_phone' => 'boolean',
        'show_email' => 'boolean',
        'show_address' => 'boolean',
        'show_website' => 'boolean',
        'show_footer' => 'boolean',
        'show_back_button' => 'boolean',
    ];

    /**
     * Get or create the singleton instance
     */
    public static function instance(): self
    {
        $settings = self::first();
        
        if (!$settings) {
            $settings = self::create(self::defaults());
        }
        
        return $settings;
    }

    /**
     * Default settings values
     */
    public static function defaults(): array
    {
        return [
            'display_mode' => 'grid',
            'items_per_row' => 3,
            'show_images' => true,
            'show_descriptions' => true,
            'show_prices' => true,
            'show_featured_badge' => true,
            'show_item_count' => true,
            'default_tab' => 'drinks',
            'show_drinks_section' => true,
            'show_food_section' => true,
            'show_rooms_section' => true,
            'show_qrcode_tab' => true,
            'tagline' => 'A luxury hotel with world-class dining facilities. Start your stay with refreshing complimentary drinks served at our lounge.',
            'show_contact_bar' => true,
            'show_phone' => true,
            'show_email' => true,
            'show_address' => true,
            'show_website' => true,
            'primary_color' => '#b59f6a',
            'background_color' => '#1a1a2e',
            'card_bg_color' => '#16213e',
            'text_color' => '#eeeeee',
            'muted_text_color' => '#aaaaaa',
            'price_color' => null,
            'show_footer' => true,
            'show_back_button' => true,
            'custom_css' => null,
        ];
    }

    /**
     * Get display mode options
     */
    public static function displayModeOptions(): array
    {
        return [
            'grid' => 'Grid View (Cards)',
            'list' => 'List View (Horizontal)',
            'compact' => 'Compact View (Small Cards)',
        ];
    }

    /**
     * Get items per row options
     */
    public static function itemsPerRowOptions(): array
    {
        return [
            2 => '2 Items',
            3 => '3 Items',
            4 => '4 Items',
            5 => '5 Items',
        ];
    }

    /**
     * Get default tab options
     */
    public static function defaultTabOptions(): array
    {
        return [
            'drinks' => 'Drinks',
            'food' => 'Food',
            'rooms' => 'Rooms',
        ];
    }

    /**
     * Get price color (fallback to primary)
     */
    public function getPriceColorValueAttribute(): string
    {
        return $this->price_color ?? $this->primary_color;
    }

    /**
     * Reset to defaults
     */
    public function resetToDefaults(): self
    {
        $this->fill(self::defaults());
        $this->save();
        return $this;
    }
}
