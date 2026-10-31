<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPageSettings;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function edit()
    {
        $contact = ContactPageSettings::first();
        if (!$contact) {
            $contact = ContactPageSettings::create([
                'seo_title' => 'Contact Us - Kuwait Cabin Hotel Bar',
                'seo_description' => 'Get in touch with Kuwait Cabin Hotel Bar',
                'sections' => ContactPageSettings::defaultSections(),
                'section_order' => ContactPageSettings::sectionKeys(),
                'page_styles' => ContactPageSettings::defaultPageStyles(),
                'content' => [],
            ]);
        }

        return view('admin.contact-page', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = ContactPageSettings::first();
        if (!$contact) {
            $contact = new ContactPageSettings();
        }

        // SEO fields
        $contact->seo_title = $request->input('seo_title');
        $contact->seo_description = $request->input('seo_description');

        // Section order (from drag & drop)
        $sectionOrder = $request->input('section_order', []);
        if (!empty($sectionOrder)) {
            $contact->section_order = array_values($sectionOrder);
        }

        // Page styles
        $pageStyles = $request->input('page_styles', []);
        $pageStyles = array_filter($pageStyles, fn($v) => $v !== null && $v !== '');
        $contact->page_styles = $pageStyles;

        // Section visibility
        $sections = $contact->sections ?? ContactPageSettings::defaultSections();
        foreach (ContactPageSettings::sectionKeys() as $key) {
            $visible = $request->boolean("sections.$key.visible");
            if (!isset($sections[$key])) {
                $sections[$key] = ['visible' => true];
            }
            $sections[$key]['visible'] = $visible;
        }
        $contact->sections = $sections;

        // Content fields
        $contentInput = $request->input('content', []);
        $content = $contact->content ?? [];
        foreach ($contentInput as $key => $value) {
            if ($value !== null && $value !== '') {
                $content[$key] = $value;
            } else {
                unset($content[$key]);
            }
        }
        $contact->content = $content;

        $contact->save();

        return redirect()->route('admin.contact-page.edit')->with('status', 'Contact page updated successfully!');
    }

    public function reset()
    {
        $contact = ContactPageSettings::first();
        if ($contact) {
            $contact->section_order = ContactPageSettings::sectionKeys();
            $contact->page_styles = ContactPageSettings::defaultPageStyles();
            $contact->sections = ContactPageSettings::defaultSections();
            $contact->save();
        }

        return redirect()->route('admin.contact-page.edit')->with('status', 'Contact page reset to defaults!');
    }
}

