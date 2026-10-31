<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageSettings;

class HomePageController extends Controller
{
    public function edit()
    {
        $home = HomePageSettings::getCurrent();
        return view('admin.home-page', [
            'home' => $home,
            'sections' => array_keys(HomePageSettings::defaultSections()),
        ]);
    }

    public function update(Request $request)
    {
        $home = HomePageSettings::first() ?? new HomePageSettings();

        // SEO
        $home->seo_title = $request->input('seo_title');
        $home->seo_description = $request->input('seo_description');

        // Section order (from drag & drop)
        $sectionOrder = $request->input('section_order', []);
        // If sectionOrder is a JSON string, decode it
        if (is_string($sectionOrder)) {
            $sectionOrder = json_decode($sectionOrder, true) ?? [];
        }
        if (!empty($sectionOrder)) {
            $home->section_order = array_values($sectionOrder);
        }

        // Page styles
        $pageStyles = $request->input('page_styles', []);
        // If pageStyles is a JSON string, decode it
        if (is_string($pageStyles)) {
            $pageStyles = json_decode($pageStyles, true) ?? [];
        }
        // Clean empty values
        $pageStyles = array_filter($pageStyles, fn($v) => $v !== null && $v !== '');
        $home->page_styles = $pageStyles;

        // Sections visibility
        $known = array_keys(HomePageSettings::defaultSections());
        $sections = $home->sections ?? HomePageSettings::defaultSections();
        // If $sections is a string (should be array), decode it
        if (is_string($sections)) {
            $decoded = json_decode($sections, true);
            $sections = is_array($decoded) ? $decoded : HomePageSettings::defaultSections();
        }
        // Extra harden: if $sections is not array, forcibly set to default
        if (!is_array($sections)) {
            $sections = HomePageSettings::defaultSections();
        }
        foreach ($known as $key) {
            $visible = $request->boolean("sections.$key.visible");
            if (!isset($sections[$key]) || !is_array($sections[$key])) {
                $sections[$key] = ['visible' => true];
            }
            $sections[$key]['visible'] = $visible;
            // Remove old html key if present
            unset($sections[$key]['html']);
        }
        $home->sections = $sections;

        // Content fields
        $contentInput = $request->input('content', []);
        $content = $home->content ?? [];
        // If $content is a string (should be array), decode it
        if (is_string($content)) {
            $decoded = json_decode($content, true);
            $content = is_array($decoded) ? $decoded : [];
        }
        if (!is_array($content)) {
            $content = [];
        }
        foreach ($contentInput as $key => $value) {
            // Store non-empty values, remove empty ones
            if ($value !== null && $value !== '') {
                $content[$key] = $value;
            } else {
                unset($content[$key]);
            }
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                if ($file && $file->isValid()) {
                    $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home'), $filename);
                    $content[$key] = '/uploads/home/' . $filename;
                }
            }
        }

        // Handle hero slides
        $heroSlides = [];
        $slidesInput = $request->input('hero_slides', []);
        $slidesFiles = $request->file('hero_slides', []);
        
        foreach ($slidesInput as $index => $slideData) {
            $slide = [
                'title' => $slideData['title'] ?? '',
                'subtitle' => $slideData['subtitle'] ?? '',
                'image' => $slideData['existing_image'] ?? '',
            ];
            
            // Check if new image uploaded for this slide
            if (isset($slidesFiles[$index]['image']) && $slidesFiles[$index]['image']->isValid()) {
                $file = $slidesFiles[$index]['image'];
                $filename = 'hero_slide_' . $index . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/home'), $filename);
                $slide['image'] = '/uploads/home/' . $filename;
            }
            
            // Only add slide if it has an image
            if (!empty($slide['image'])) {
                $heroSlides[] = $slide;
            }
        }
        
        $content['hero_slides'] = $heroSlides;

        $home->content = $content;

        $home->save();

        return redirect()->route('admin.home-page.edit')->with('status', 'Home page settings updated.');
    }

    public function reset()
    {
        $home = HomePageSettings::first();
        if ($home) {
            $home->section_order = HomePageSettings::sectionKeys();
            $home->page_styles = HomePageSettings::defaultPageStyles();
            $home->sections = HomePageSettings::defaultSections();
            $home->save();
        }

        return redirect()->route('admin.home-page.edit')->with('status', 'Home page reset to defaults!');
    }
}

