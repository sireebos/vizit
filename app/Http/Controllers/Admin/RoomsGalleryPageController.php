<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomsGalleryPageSettings;
use Illuminate\Http\Request;

class RoomsGalleryPageController extends Controller
{
    public function edit()
    {
        $page = RoomsGalleryPageSettings::first();
        if (!$page) {
            $page = RoomsGalleryPageSettings::create([
                'seo_title' => 'Room Gallery',
                'seo_description' => 'View our room gallery',
                'sections' => RoomsGalleryPageSettings::defaultSections(),
                'section_order' => RoomsGalleryPageSettings::sectionKeys(),
                'page_styles' => RoomsGalleryPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }
        return view('admin.rooms-gallery-page', compact('page'));
    }

    public function update(Request $request)
    {
        $page = RoomsGalleryPageSettings::first();
        if (!$page) {
            $page = new RoomsGalleryPageSettings();
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
        $sections = $page->sections ?? RoomsGalleryPageSettings::defaultSections();
        foreach (RoomsGalleryPageSettings::sectionKeys() as $section) {
            $visible = $request->boolean("sections.$section.visible");
            if (!isset($sections[$section])) {
                $sections[$section] = ['visible' => true];
            }
            $sections[$section]['visible'] = $visible;
        }
        $page->sections = $sections;
        $page->content = $request->input('content', []);
        $page->save();

        return redirect()->route('admin.rooms-gallery-page.edit')->with('success', 'Rooms Gallery page updated successfully!');
    }

    public function reset()
    {
        $page = RoomsGalleryPageSettings::first();
        if ($page) {
            $page->section_order = RoomsGalleryPageSettings::sectionKeys();
            $page->page_styles = RoomsGalleryPageSettings::defaultPageStyles();
            $page->sections = RoomsGalleryPageSettings::defaultSections();
            $page->save();
        }

        return redirect()->route('admin.rooms-gallery-page.edit')->with('success', 'Rooms Gallery page reset to defaults!');
    }
}

