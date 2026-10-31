<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeSettings;
use Illuminate\Http\Request;

class ThemeSettingsController extends Controller
{
    public function edit()
    {
        $theme = ThemeSettings::instance();
        $fonts = ThemeSettings::availableFonts();
        return view('admin.theme-settings', compact('theme', 'fonts'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'primary_color' => 'required|string|max:20',
            'secondary_color' => 'required|string|max:20',
            'accent_color' => 'required|string|max:20',
            'text_color' => 'required|string|max:20',
            'heading_color' => 'required|string|max:20',
            'link_color' => 'required|string|max:20',
            'button_color' => 'required|string|max:20',
            'button_hover_color' => 'required|string|max:20',
            'footer_bg_color' => 'required|string|max:20',
            'footer_text_color' => 'required|string|max:20',
            'reveal_color' => 'nullable|string|max:20',
            'loader_bg_color' => 'nullable|string|max:20',
            'loader_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'heading_font' => 'required|string|max:50',
            'body_font' => 'required|string|max:50',
            'header_style' => 'required|in:dark,light,transparent',
            'sticky_header' => 'nullable',
            'show_top_bar' => 'nullable',
            'button_style' => 'required|in:rounded,square,pill',
            'layout_style' => 'required|in:wide,boxed',
            'custom_css' => 'nullable|string|max:10000',
        ]);

        $validated['sticky_header'] = (bool) $request->input('sticky_header', 0);
        $validated['show_top_bar'] = (bool) $request->input('show_top_bar', 0);

        $theme = ThemeSettings::instance();
        
        // Handle loader image upload
        if ($request->hasFile('loader_image')) {
            $file = $request->file('loader_image');
            $filename = time() . '_loader.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/uploads'), $filename);
            $validated['loader_image'] = '/storage/uploads/' . $filename;
        }
        
        // Handle remove loader image
        if ($request->input('remove_loader_image')) {
            $validated['loader_image'] = null;
        }
        
        // Remove file from validated if not uploaded
        if (!$request->hasFile('loader_image') && !$request->input('remove_loader_image')) {
            unset($validated['loader_image']);
        }
        
        $theme->update($validated);

        return redirect()->route('admin.theme-settings.edit')->with('success', 'Theme settings updated successfully!');
    }

    public function reset()
    {
        $theme = ThemeSettings::instance();
        $theme->update([
            'primary_color' => '#f7c51e',
            'secondary_color' => '#1a2a3a',
            'accent_color' => '#f7c51e',
            'text_color' => '#333333',
            'heading_color' => '#1a2a3a',
            'link_color' => '#f7c51e',
            'button_color' => '#f7c51e',
            'button_hover_color' => '#e0b300',
            'footer_bg_color' => '#1a2a3a',
            'footer_text_color' => '#cccccc',
            'reveal_color' => '#1a2a3a',
            'loader_bg_color' => '#ffffff',
            'loader_image' => null,
            'heading_font' => 'Playfair Display',
            'body_font' => 'Poppins',
            'header_style' => 'dark',
            'sticky_header' => true,
            'show_top_bar' => true,
            'button_style' => 'rounded',
            'layout_style' => 'wide',
            'custom_css' => null,
        ]);

        return redirect()->route('admin.theme-settings.edit')->with('success', 'Theme reset to default settings!');
    }
}
