<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesPageSettings;
use Illuminate\Http\Request;

class ServicesPageController extends Controller
{
    public function edit()
    {
        $page = ServicesPageSettings::first();
        if (!$page) {
            $page = ServicesPageSettings::create([
                'seo_title' => 'Services',
                'seo_description' => 'Our services',
                'sections' => ServicesPageSettings::defaultSections(),
                'section_order' => ServicesPageSettings::sectionKeys(),
                'page_styles' => ServicesPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }
        return view('admin.services-page', compact('page'));
    }

    public function update(Request $request)
    {
        $page = ServicesPageSettings::first();
        if (!$page) {
            $page = new ServicesPageSettings();
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
        $sections = $page->sections ?? ServicesPageSettings::defaultSections();
        foreach (ServicesPageSettings::sectionKeys() as $section) {
            $visible = $request->boolean("sections.$section.visible");
            if (!isset($sections[$section])) {
                $sections[$section] = ['visible' => true];
            }
            $sections[$section]['visible'] = $visible;
        }
        $page->sections = $sections;
        $page->content = $request->input('content', []);
        $page->save();

        return redirect()->route('admin.services-page.edit')->with('success', 'Services page updated successfully!');
    }

    public function reset()
    {
        $page = ServicesPageSettings::first();
        if ($page) {
            $page->section_order = ServicesPageSettings::sectionKeys();
            $page->page_styles = ServicesPageSettings::defaultPageStyles();
            $page->sections = ServicesPageSettings::defaultSections();
            $page->save();
        }

        return redirect()->route('admin.services-page.edit')->with('success', 'Services page reset to defaults!');
    }
}

