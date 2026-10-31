<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantPageSettings;
use Illuminate\Http\Request;

class RestaurantPageController extends Controller
{
    public function edit()
    {
        $page = RestaurantPageSettings::first();
        if (!$page) {
            $page = RestaurantPageSettings::create([
                'seo_title' => 'Restaurant',
                'seo_description' => 'Our restaurant',
                'sections' => RestaurantPageSettings::defaultSections(),
                'section_order' => RestaurantPageSettings::sectionKeys(),
                'page_styles' => RestaurantPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }
        return view('admin.restaurant-page', compact('page'));
    }

    public function update(Request $request)
    {
        $page = RestaurantPageSettings::first();
        if (!$page) {
            $page = new RestaurantPageSettings();
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
        $sections = $page->sections ?? RestaurantPageSettings::defaultSections();
        foreach (RestaurantPageSettings::sectionKeys() as $section) {
            $visible = $request->boolean("sections.$section.visible");
            if (!isset($sections[$section])) {
                $sections[$section] = ['visible' => true];
            }
            $sections[$section]['visible'] = $visible;
        }
        $page->sections = $sections;
        $page->content = $request->input('content', []);
        $page->save();

        return redirect()->route('admin.restaurant-page.edit')->with('success', 'Restaurant page updated successfully!');
    }

    public function reset()
    {
        $page = RestaurantPageSettings::first();
        if ($page) {
            $page->section_order = RestaurantPageSettings::sectionKeys();
            $page->page_styles = RestaurantPageSettings::defaultPageStyles();
            $page->sections = RestaurantPageSettings::defaultSections();
            $page->save();
        }

        return redirect()->route('admin.restaurant-page.edit')->with('success', 'Restaurant page reset to defaults!');
    }
}

