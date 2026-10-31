<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SearchPageSettings;
use Illuminate\Http\Request;

class SearchPageController extends Controller
{
    public function edit()
    {
        $page = SearchPageSettings::first();
        if (!$page) {
            $page = SearchPageSettings::create([
                'seo_title' => 'Search Rooms',
                'seo_description' => 'Search for available rooms',
                'sections' => SearchPageSettings::defaultSections(),
                'section_order' => SearchPageSettings::sectionKeys(),
                'page_styles' => SearchPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }
        return view('admin.search-page', compact('page'));
    }

    public function update(Request $request)
    {
        $page = SearchPageSettings::first();
        if (!$page) {
            $page = new SearchPageSettings();
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
        $sections = $page->sections ?? SearchPageSettings::defaultSections();
        foreach (SearchPageSettings::sectionKeys() as $section) {
            $visible = $request->boolean("sections.$section.visible");
            if (!isset($sections[$section])) {
                $sections[$section] = ['visible' => true];
            }
            $sections[$section]['visible'] = $visible;
        }
        $page->sections = $sections;
        $page->content = $request->input('content', []);
        $page->save();

        return redirect()->route('admin.search-page.edit')->with('success', 'Search page updated successfully!');
    }

    public function reset()
    {
        $page = SearchPageSettings::first();
        if ($page) {
            $page->section_order = SearchPageSettings::sectionKeys();
            $page->page_styles = SearchPageSettings::defaultPageStyles();
            $page->sections = SearchPageSettings::defaultSections();
            $page->save();
        }

        return redirect()->route('admin.search-page.edit')->with('success', 'Search page reset to defaults!');
    }
}

