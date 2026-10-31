<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomsPageSettings;
use Illuminate\Http\Request;

class RoomsPageController extends Controller
{
    public function edit()
    {
        $page = RoomsPageSettings::first();
        if (!$page) {
            $page = RoomsPageSettings::create([
                'seo_title' => 'Our Rooms',
                'seo_description' => 'View our rooms',
                'sections' => RoomsPageSettings::defaultSections(),
                'section_order' => RoomsPageSettings::sectionKeys(),
                'page_styles' => RoomsPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }
        return view('admin.rooms-page', compact('page'));
    }

    public function update(Request $request)
    {
        $page = RoomsPageSettings::first();
        if (!$page) {
            $page = new RoomsPageSettings();
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
        $sections = $page->sections ?? RoomsPageSettings::defaultSections();
        foreach (RoomsPageSettings::sectionKeys() as $section) {
            $visible = $request->boolean("sections.$section.visible");
            if (!isset($sections[$section])) {
                $sections[$section] = ['visible' => true];
            }
            $sections[$section]['visible'] = $visible;
        }
        $page->sections = $sections;
        $page->content = $request->input('content', []);
        $page->save();

        return redirect()->route('admin.rooms-page.edit')->with('success', 'Rooms page updated successfully!');
    }

    public function reset()
    {
        $page = RoomsPageSettings::first();
        if ($page) {
            $page->section_order = RoomsPageSettings::sectionKeys();
            $page->page_styles = RoomsPageSettings::defaultPageStyles();
            $page->sections = RoomsPageSettings::defaultSections();
            $page->save();
        }

        return redirect()->route('admin.rooms-page.edit')->with('success', 'Rooms page reset to defaults!');
    }
}

