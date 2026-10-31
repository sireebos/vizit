<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSettings;

class WebsiteSettingsController extends Controller
{
    public function index()
    {
        $settings = WebsiteSettings::getSettings();
        return view('admin.website-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|url',
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'accent_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_primary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_secondary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_primary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_secondary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_tertiary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'border_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'font_primary' => 'required|string|max:255',
            'font_secondary' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
                'home_about_title' => 'nullable|string|max:255',
                'home_about_text' => 'nullable|string',
                'home_stay_title' => 'nullable|string|max:255',
                'home_eat_title' => 'nullable|string|max:255',
                'home_gallery_title' => 'nullable|string|max:255',
        ]);

        $settings = WebsiteSettings::first();

        if ($settings) {
            $settings->update($request->all());
        } else {
            WebsiteSettings::create($request->all());
        }

        return redirect()->route('admin.website-settings')
                        ->with('success', 'Website settings updated successfully!');
    }
}
