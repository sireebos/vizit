<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSettings extends Model
{
    protected $table = 'home_page_settings';

    protected $fillable = [
        'seo_title',
        'seo_description',
        'sections', // JSON: { key: { visible: bool } }
        'section_order', // JSON: array of section keys in order
        'page_styles', // JSON: { background_color, text_color, heading_color, accent_color, background_image }
        'content',  // JSON: { key: value } for all editable content
    ];

    protected $casts = [
        'sections' => 'array',
        'section_order' => 'array',
        'page_styles' => 'array',
        'content' => 'array',
    ];

    public static function sectionKeys(): array
    {
        return [
            'hero',
            'booking_bar',
            'intro',
            'features_pair',
            'services_grid',
            'features_grid',
            'parallax_cta',
            'rooms',
            'quotes',
            'video',
            'restaurants',
        ];
    }

    public static function sectionLabels(): array
    {
        return [
            'hero' => 'Hero Section',
            'booking_bar' => 'Booking Bar',
            'intro' => 'Intro Section',
            'features_pair' => 'Features Pair',
            'services_grid' => 'Services Grid',
            'features_grid' => 'Features Grid',
            'parallax_cta' => 'Parallax CTA',
            'rooms' => 'Rooms Section',
            'quotes' => 'Quotes/Testimonials',
            'video' => 'Video Section',
            'restaurants' => 'Restaurants Section',
        ];
    }

    public static function defaultSections(): array
    {
        $defaults = [];
        foreach (self::sectionKeys() as $k) {
            $defaults[$k] = ['visible' => true];
        }
        return $defaults;
    }

    public static function defaultPageStyles(): array
    {
        return [
            'background_color' => '',
            'text_color' => '',
            'heading_color' => '',
            'accent_color' => '',
            'background_image' => '',
            'custom_css' => '',
        ];
    }

    public static function getCurrent(): self
    {
        try {
            $model = self::first();
        } catch (\Throwable $e) {
            $model = new self();
        }
        if (!$model) {
            $model = new self();
        }
        $sections = $model->sections ?? [];
        $model->sections = array_replace_recursive(self::defaultSections(), is_array($sections) ? $sections : []);
        return $model;
    }

    public function visible(string $key): bool
    {
        $sections = $this->sections ?? [];
        return (bool)($sections[$key]['visible'] ?? true);
    }

    public function content(string $key, $default = null)
    {
        $content = $this->content ?? [];
        return $content[$key] ?? $default;
    }

    /**
     * Get hero slides array
     */
    public function getHeroSlides(): array
    {
        $slides = $this->content('hero_slides', []);
        return is_array($slides) ? $slides : [];
    }

    /**
     * Get hero type (default or slider)
     */
    public function getHeroType(): string
    {
        return $this->content('hero_type', 'default');
    }

    public function setVisibility(string $key, bool $visible): void
    {
        $sections = $this->sections ?? self::defaultSections();
        if (!isset($sections[$key])) {
            $sections[$key] = ['visible' => true];
        }
        $sections[$key]['visible'] = $visible;
        $this->sections = $sections;
    }

    public function setContent(string $key, $value): void
    {
        $content = $this->content ?? [];
        $content[$key] = $value;
        $this->content = $content;
    }

    /**
     * Get ordered section keys
     */
    public function getOrderedSections(): array
    {
        $order = $this->section_order;
        $allKeys = self::sectionKeys();
        
        if (empty($order) || !is_array($order)) {
            return $allKeys;
        }
        
        // Ensure all sections are included (in case new ones were added)
        $missing = array_diff($allKeys, $order);
        return array_merge($order, $missing);
    }

    /**
     * Get page style value
     */
    public function pageStyle(string $key, $default = '')
    {
        $styles = $this->page_styles ?? [];
        return $styles[$key] ?? $default;
    }

    /**
     * Generate CSS variables for page-specific styles
     */
    public function getPageCssVariables(): string
    {
        $styles = $this->page_styles ?? [];
        $css = '';
        
        if (!empty($styles['background_color'])) {
            $css .= "--page-bg-color: {$styles['background_color']};";
        }
        if (!empty($styles['text_color'])) {
            $css .= "--page-text-color: {$styles['text_color']};";
        }
        if (!empty($styles['heading_color'])) {
            $css .= "--page-heading-color: {$styles['heading_color']};";
        }
        if (!empty($styles['accent_color'])) {
            $css .= "--page-accent-color: {$styles['accent_color']};";
        }
        
        return $css;
    }
}

