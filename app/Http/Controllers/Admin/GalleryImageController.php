<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function index()
    {
        $images = GalleryImage::ordered()->get();
        return view('admin.gallery-images.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery-images.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_url' => 'required|string',
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ]);
        $validated['is_active'] = (bool) $request->input('is_active', 0);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        GalleryImage::create($validated);
        return redirect()->route('admin.gallery-images.index')->with('success', 'Gallery image created.');
    }

    public function edit(GalleryImage $gallery_image)
    {
        return view('admin.gallery-images.edit', ['image' => $gallery_image]);
    }

    public function update(Request $request, GalleryImage $gallery_image)
    {
        $validated = $request->validate([
            'image_url' => 'required|string',
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable',
        ]);
        $validated['is_active'] = (bool) $request->input('is_active', 0);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $gallery_image->update($validated);
        return redirect()->route('admin.gallery-images.index')->with('success', 'Gallery image updated.');
    }

    public function destroy(GalleryImage $gallery_image)
    {
        $gallery_image->delete();
        return redirect()->route('admin.gallery-images.index')->with('success', 'Gallery image deleted.');
    }
}

