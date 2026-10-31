<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPageSettings extends Model
{
    protected $table = 'contact_page_settings';

    protected $fillable = [
        'seo_title',
        'seo_description',
        'sections',
        'section_order',
        'page_styles',
        'content',
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
            'video',
            'contact_form',
            'contact_info',
            'newsletter',
            'map',
        ];
    }

    public static function sectionLabels(): array
    {
        return [
            'hero' => 'Hero Section',
            'video' => 'Video Section',
            'contact_form' => 'Contact Form',
            'contact_info' => 'Contact Info',
            'newsletter' => 'Newsletter Section',
            'map' => 'Map Section',
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

    /**
     * Check if a section is visible
     */
    public function visible(string $key): bool
    {
        $sections = $this->sections ?? [];
        return (bool)($sections[$key]['visible'] ?? true);
    }

    /**
     * Get content value with default
     */
    public function content(string $key, $default = null)
    {
        $content = $this->content ?? [];
        return $content[$key] ?? $default;
    }

    /**
     * Set section visibility
     */
    public function setVisibility(string $key, bool $visible): void
    {
        $sections = $this->sections ?? [];
        $sections[$key]['visible'] = $visible;
        $this->sections = $sections;
    }

    /**
     * Set content value
     */
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
}

