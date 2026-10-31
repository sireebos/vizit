<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantMenu;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class FoodMenuController extends Controller
{
    public function index()
    {
        $menuItems = RestaurantMenu::orderBy('category')->orderBy('sort_order')->orderBy('name')->get();
        $categories = RestaurantMenu::getCategories();
        $siteSettings = SiteSettings::first();
        return view('admin.food-menu.index', compact('menuItems', 'categories', 'siteSettings'));
    }

    public function create()
    {
        $categories = RestaurantMenu::getCategories();
        $siteSettings = SiteSettings::first();
        return view('admin.food-menu.create', compact('categories', 'siteSettings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'ingredients' => 'nullable|array',
            'allergens' => 'nullable|array',
            'preparation_time' => 'nullable|integer|min:0',
            'is_vegetarian' => 'boolean',
            'is_vegan' => 'boolean',
            'is_spicy' => 'boolean',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_vegetarian'] = $request->has('is_vegetarian');
        $validated['is_vegan'] = $request->has('is_vegan');
        $validated['is_spicy'] = $request->has('is_spicy');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['ingredients'] = array_filter($request->input('ingredients', []));
        $validated['allergens'] = array_filter($request->input('allergens', []));

        RestaurantMenu::create($validated);

        return redirect()->route('admin.food-menu.index')->with('success', 'Menu item created successfully!');
    }

    public function show(RestaurantMenu $foodMenu)
    {
        return view('admin.food-menu.show', ['menuItem' => $foodMenu]);
    }

    public function edit(RestaurantMenu $foodMenu)
    {
        $categories = RestaurantMenu::getCategories();
        $siteSettings = SiteSettings::first();
        return view('admin.food-menu.edit', ['menuItem' => $foodMenu, 'categories' => $categories, 'siteSettings' => $siteSettings]);
    }

    public function update(Request $request, RestaurantMenu $foodMenu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'ingredients' => 'nullable|array',
            'allergens' => 'nullable|array',
            'preparation_time' => 'nullable|integer|min:0',
            'is_vegetarian' => 'boolean',
            'is_vegan' => 'boolean',
            'is_spicy' => 'boolean',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_vegetarian'] = $request->has('is_vegetarian');
        $validated['is_vegan'] = $request->has('is_vegan');
        $validated['is_spicy'] = $request->has('is_spicy');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['ingredients'] = array_filter($request->input('ingredients', []));
        $validated['allergens'] = array_filter($request->input('allergens', []));

        $foodMenu->update($validated);

        return redirect()->route('admin.food-menu.index')->with('success', 'Menu item updated successfully!');
    }

    public function destroy(RestaurantMenu $foodMenu)
    {
        $foodMenu->delete();
        return redirect()->route('admin.food-menu.index')->with('success', 'Menu item deleted successfully!');
    }
}

