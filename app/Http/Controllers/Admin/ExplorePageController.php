<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExplorePageSettings;
use App\Models\RoomType;
use Illuminate\Http\Request;

class ExplorePageController extends Controller
{
    public function edit()
    {
        $page = ExplorePageSettings::first();
        if (!$page) {
            $page = ExplorePageSettings::create([
                'seo_title' => 'Explore',
                'seo_description' => 'Explore our hotel',
                'sections' => ExplorePageSettings::defaultSections(),
                'section_order' => ExplorePageSettings::sectionKeys(),
                'page_styles' => ExplorePageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }
        
        // Get room types to show in admin info
        $roomTypes = RoomType::where('is_active', true)->orderBy('sort_order')->take(3)->get();
        
        return view('admin.explore-page', compact('page', 'roomTypes'));
    }

    public function update(Request $request)
    {
        $page = ExplorePageSettings::first();
        if (!$page) {
            $page = new ExplorePageSettings();
        }

        $page->seo_title = $request->input('seo_title');
        $page->seo_description = $request->input('seo_description');

        // Section order (from drag & drop)
        $sectionOrder = $request->input('section_order', []);
        if (!empty($sectionOrder)) {
            $page->section_order = array_values($sectionOrder);
        }

        // Page styles
        $pageStyles = $request->input('page_styles', []);
        $pageStyles = array_filter($pageStyles, fn($v) => $v !== null && $v !== '');
        $page->page_styles = $pageStyles;

        // Sections visibility
        $sections = $page->sections ?? ExplorePageSettings::defaultSections();
        foreach (ExplorePageSettings::sectionKeys() as $section) {
            $visible = $request->boolean("sections.$section.visible");
            if (!isset($sections[$section])) {
                $sections[$section] = ['visible' => true];
            }
            $sections[$section]['visible'] = $visible;
        }
        $page->sections = $sections;
        $page->content = $request->input('content', []);
        $page->save();

        return redirect()->route('admin.explore-page.edit')->with('success', 'Explore page updated successfully!');
    }

    public function reset()
    {
        $page = ExplorePageSettings::first();
        if ($page) {
            $page->section_order = ExplorePageSettings::sectionKeys();
            $page->page_styles = ExplorePageSettings::defaultPageStyles();
            $page->sections = ExplorePageSettings::defaultSections();
            $page->save();
        }

        return redirect()->route('admin.explore-page.edit')->with('success', 'Explore page reset to defaults!');
    }
}

