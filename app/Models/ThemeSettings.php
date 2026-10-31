<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSettings extends Model
{
    protected $table = 'theme_settings';

    protected $fillable = [
        'primary_color',
        'secondary_color',
        'accent_color',
        'text_color',
        'heading_color',
        'link_color',
        'button_color',
        'button_hover_color',
        'footer_bg_color',
        'footer_text_color',
        'reveal_color',
        'loader_image',
        'loader_bg_color',
        'heading_font',
        'body_font',
        'header_style',
        'sticky_header',
        'show_top_bar',
        'button_style',
        'layout_style',
        'custom_css',
    ];

    protected $casts = [
        'sticky_header' => 'boolean',
        'show_top_bar' => 'boolean',
    ];

    /**
     * Get the singleton instance of theme settings
     */
    public static function instance(): self
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([
                'primary_color' => '#aa8453',
                'secondary_color' => '#1b1b1b',
                'accent_color' => '#c9a66b',
            ]);
        }
        return $settings;
    }

    /**
     * Get CSS variables string
     */
    public function getCssVariables(): string
    {
        return "
            --primary-color: {$this->primary_color};
            --secondary-color: {$this->secondary_color};
            --accent-color: {$this->accent_color};
            --text-color: {$this->text_color};
            --heading-color: {$this->heading_color};
            --link-color: {$this->link_color};
            --button-color: {$this->button_color};
            --button-hover-color: {$this->button_hover_color};
            --footer-bg-color: {$this->footer_bg_color};
            --footer-text-color: {$this->footer_text_color};
            --reveal-color: " . ($this->reveal_color ?? '#1a2a3a') . ";
            --loader-bg-color: " . ($this->loader_bg_color ?? '#ffffff') . ";
            --heading-font: '{$this->heading_font}', sans-serif;
            --body-font: '{$this->body_font}', sans-serif;
        ";
    }

    /**
     * Available Google Fonts
     */
    public static function availableFonts(): array
    {
        return [
            'Poppins' => 'Poppins',
            'Roboto' => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato' => 'Lato',
            'Montserrat' => 'Montserrat',
            'Playfair Display' => 'Playfair Display',
            'Raleway' => 'Raleway',
            'Nunito' => 'Nunito',
            'Source Sans Pro' => 'Source Sans Pro',
            'Oswald' => 'Oswald',
            'Merriweather' => 'Merriweather',
            'PT Sans' => 'PT Sans',
            'Ubuntu' => 'Ubuntu',
            'Rubik' => 'Rubik',
            'Work Sans' => 'Work Sans',
        ];
    }
}
