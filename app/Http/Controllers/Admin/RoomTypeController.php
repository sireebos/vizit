<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomType::with('rooms')->orderBy('sort_order')->get();
        $siteSettings = SiteSettings::first();
        return view('admin.room-types.index', compact('roomTypes', 'siteSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'stars' => 'nullable|integer|min:1|max:5',
            'max_occupancy' => 'required|integer|min:1|max:10',
            'max_adults' => 'required|integer|min:1',
            'max_children' => 'required|integer|min:0',
            'size_sqft' => 'nullable|numeric|min:0',
            'amenities' => 'nullable|array',
            'images' => 'nullable|array',
            'images.*' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['amenities'] = array_filter($request->amenities ?? []);
        $data['images'] = array_filter($request->images ?? []);
        $data['is_active'] = $request->has('is_active');
        $data['stars'] = $request->stars ?? 5;

        RoomType::create($data);

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Room type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        $roomType->load('rooms');
        $siteSettings = SiteSettings::first();
        return view('admin.room-types.show', compact('roomType', 'siteSettings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        return view('admin.room-types.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'stars' => 'nullable|integer|min:1|max:5',
            'max_occupancy' => 'required|integer|min:1|max:10',
            'max_adults' => 'required|integer|min:1',
            'max_children' => 'required|integer|min:0',
            'size_sqft' => 'nullable|numeric|min:0',
            'amenities' => 'nullable|array',
            'images' => 'nullable|array',
            'images.*' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['amenities'] = array_filter($request->amenities ?? []);
        $data['images'] = array_filter($request->images ?? []);
        $data['is_active'] = $request->has('is_active');

        $roomType->update($data);

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Room type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        // Check if room type has associated rooms
        if ($roomType->rooms()->count() > 0) {
            return redirect()->route('admin.room-types.index')
                ->with('error', 'Cannot delete room type with associated rooms.');
        }

        $roomType->delete();

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Room type deleted successfully.');
    }
}
