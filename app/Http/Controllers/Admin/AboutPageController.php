<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPageSettings;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function edit()
    {
        $about = AboutPageSettings::first();
        if (!$about) {
            $about = AboutPageSettings::create([
                'seo_title' => 'About Us - Kuwait Cabin Hotel Bar',
                'seo_description' => 'Learn more about Kuwait Cabin Hotel Bar',
                'sections' => AboutPageSettings::defaultSections(),
                'section_order' => AboutPageSettings::sectionKeys(),
                'page_styles' => AboutPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }

        return view('admin.about-page', compact('about'));
    }

    public function update(Request $request)
    {
        $about = AboutPageSettings::first();
        if (!$about) {
            $about = new AboutPageSettings();
        }

        // SEO fields
        $about->seo_title = $request->input('seo_title');
        $about->seo_description = $request->input('seo_description');

        // Section order (from drag & drop)
        $sectionOrder = $request->input('section_order', []);
        if (!empty($sectionOrder)) {
            $about->section_order = array_values($sectionOrder);
        }

        // Page styles
        $pageStyles = $request->input('page_styles', []);
        $pageStyles = array_filter($pageStyles, fn($v) => $v !== null && $v !== '');
        $about->page_styles = $pageStyles;

        // Section visibility
        $sectionsInput = $request->input('sections', []);
        $sections = $about->sections ?? AboutPageSettings::defaultSections();
        foreach (AboutPageSettings::sectionKeys() as $key) {
            $visible = $request->boolean("sections.$key.visible");
            if (!isset($sections[$key])) {
                $sections[$key] = ['visible' => true];
            }
            $sections[$key]['visible'] = $visible;
        }
        $about->sections = $sections;

        // Content fields
        $contentInput = $request->input('content', []);
        $content = $about->content ?? [];
        foreach ($contentInput as $key => $value) {
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
                    $filename = 'about_' . $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/about'), $filename);
                    $content[$key] = '/uploads/about/' . $filename;
                }
            }
        }

        $about->content = $content;

        $about->save();

        return redirect()->route('admin.about-page.edit')->with('status', 'About page updated successfully!');
    }

    public function reset()
    {
        $about = AboutPageSettings::first();
        if ($about) {
            $about->section_order = AboutPageSettings::sectionKeys();
            $about->page_styles = AboutPageSettings::defaultPageStyles();
            $about->sections = AboutPageSettings::defaultSections();
            $about->save();
        }

        return redirect()->route('admin.about-page.edit')->with('status', 'About page reset to defaults!');
    }
}

