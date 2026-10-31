<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TandcPageSettings;
use Illuminate\Http\Request;

class TandcPageController extends Controller
{
    public function edit()
    {
        $page = TandcPageSettings::first();
        if (!$page) {
            $page = TandcPageSettings::create([
                'seo_title' => 'Terms & Conditions',
                'seo_description' => 'Terms and conditions',
                'sections' => TandcPageSettings::defaultSections(),
                'section_order' => TandcPageSettings::sectionKeys(),
                'page_styles' => TandcPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }
        return view('admin.tandc-page', compact('page'));
    }

    public function update(Request $request)
    {
        $page = TandcPageSettings::first();
        if (!$page) {
            $page = new TandcPageSettings();
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
        $sections = $page->sections ?? TandcPageSettings::defaultSections();
        foreach (TandcPageSettings::sectionKeys() as $section) {
            $visible = $request->boolean("sections.$section.visible");
            if (!isset($sections[$section])) {
                $sections[$section] = ['visible' => true];
            }
            $sections[$section]['visible'] = $visible;
        }
        $page->sections = $sections;
        $page->content = $request->input('content', []);
        $page->save();

        return redirect()->route('admin.tandc-page.edit')->with('success', 'Terms & Conditions page updated successfully!');
    }

    public function reset()
    {
        $page = TandcPageSettings::first();
        if ($page) {
            $page->section_order = TandcPageSettings::sectionKeys();
            $page->page_styles = TandcPageSettings::defaultPageStyles();
            $page->sections = TandcPageSettings::defaultSections();
            $page->save();
        }

        return redirect()->route('admin.tandc-page.edit')->with('success', 'Terms & Conditions page reset to defaults!');
    }
}

