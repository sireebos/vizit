<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $table = 'site_settings';
    
    protected $fillable = [
        'site_name',
        'site_logo',
        'site_favicon',
        'header_phone',
        'header_email',
        'header_address',
        'header_menu',
        'header_bg_color',
        'header_text_color',
        'footer_subtitle',
        'footer_title',
        'footer_about',
        'footer_phone',
        'footer_email',
        'footer_address',
        'footer_website',
        'footer_copyright',
        'footer_menu',
        'footer_bg_color',
        'footer_text_color',
        'footer_heading_color',
        'footer_link_color',
        'show_scroll_buttons',
        'check_in_time',
        'check_out_time',
        'opening_hours',
        'subscribe_button',
        // Subscribe Section Styling
        'subscribe_style',
        'subscribe_title',
        'subscribe_subtitle',
        'subscribe_placeholder',
        'subscribe_input_bg',
        'subscribe_input_text',
        'subscribe_input_border',
        'subscribe_input_border_radius',
        'subscribe_btn_bg',
        'subscribe_btn_text',
        'subscribe_btn_hover_bg',
        'subscribe_btn_hover_text',
        'subscribe_btn_border_radius',
        'subscribe_btn_icon',
        'subscribe_btn_icon_only',
        'subscribe_container_bg',
        'subscribe_container_shadow',
        'subscribe_show_section',
        'partner_logo_1',
        'partner_logo_2',
        'partner_logo_3',
        'partner_logo_4',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'social_tiktok',
        'social_youtube',
        'social_tripadvisor',
        'social_booking',
        'notification_email',
        'currency_symbol',
        'currency_code',
        'currency_position',
        'custom_header_code',
        'custom_footer_code',
    ];

    /**
     * Get a setting value with a default fallback
     */
    public function get(string $key, $default = null)
    {
        return $this->{$key} ?? $default;
    }

    /**
     * Get the singleton instance of site settings
     */
    public static function instance()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([
                'site_name' => 'Kuwait Cabin Hotel Bar',
                'footer_copyright' => '© ' . date('Y') . ' Kuwait Cabin Hotel Bar. All Rights Reserved.',
            ]);
        }
        return $settings;
    }

    /**
     * Format a price with the configured currency
     */
    public function formatPrice($amount, $decimals = 0): string
    {
        $symbol = $this->currency_symbol ?: '₦';
        $position = $this->currency_position ?: 'before';
        $formatted = number_format($amount, $decimals);
        
        if ($position === 'after') {
            return $formatted . $symbol;
        }
        return $symbol . $formatted;
    }

    /**
     * Get the currency symbol
     */
    public function getCurrencySymbol(): string
    {
        return $this->currency_symbol ?: '₦';
    }
}

