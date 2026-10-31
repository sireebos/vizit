<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSettings extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_image',
        'primary_color',
        'secondary_color',
        'accent_color',
        'text_primary',
        'text_secondary',
        'background_primary',
        'background_secondary',
        'background_tertiary',
        'border_color',
        'font_primary',
        'font_secondary',
        'phone',
        'email',
        'address',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'meta_description',
        'meta_keywords',
        'home_about_title',
        'home_about_text',
        'home_stay_title',
        'home_eat_title',
        'home_gallery_title',
    ];

    public static function getSettings()
    {
        return self::first() ?? new self();
    }
}
