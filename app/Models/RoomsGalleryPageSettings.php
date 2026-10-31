<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomsGalleryPageSettings extends Model
{
    protected $table = 'rooms_gallery_page_settings';
    
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
            'amenities',
            'gallery',
            'room_details',
            'more_rooms',
        ];
    }

    public static function sectionLabels(): array
    {
        return [
            'hero' => 'Hero Section',
            'amenities' => 'Amenities Section',
            'gallery' => 'Gallery Section',
            'room_details' => 'Room Details',
            'more_rooms' => 'More Rooms',
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

    public function setVisibility(string $key, bool $visible): void
    {
        $sections = $this->sections ?? [];
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

