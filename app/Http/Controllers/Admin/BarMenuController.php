<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarMenu;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class BarMenuController extends Controller
{
    /**
     * Get available categories
     */
    public static function getCategories(): array
    {
        return [
            'beer' => 'Beer',
            'wine' => 'Wine',
            'spirits' => 'Spirits',
            'cocktail' => 'Cocktail',
            'mocktail' => 'Mocktail',
            'soft_drink' => 'Soft Drink',
            'coffee' => 'Coffee',
            'tea' => 'Tea',
        ];
    }

    public function index()
    {
        $menuItems = BarMenu::orderBy('category')->orderBy('sort_order')->orderBy('name')->get();
        $categories = self::getCategories();
        $siteSettings = SiteSettings::first();
        return view('admin.bar-menu.index', compact('menuItems', 'categories', 'siteSettings'));
    }

    public function create()
    {
        $categories = self::getCategories();
        $siteSettings = SiteSettings::first();
        return view('admin.bar-menu.create', compact('categories', 'siteSettings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|in:beer,wine,spirits,cocktail,mocktail,soft_drink,coffee,tea',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'ingredients' => 'nullable|array',
            'alcohol_content' => 'nullable|numeric|min:0|max:100',
            'serving_size' => 'nullable|string|max:50',
            'preparation_time' => 'nullable|integer|min:0',
            'preparation_notes' => 'nullable|string',
            'is_alcoholic' => 'boolean',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'cost_price' => 'nullable|numeric|min:0',
        ]);

        $validated['is_alcoholic'] = $request->has('is_alcoholic');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['ingredients'] = array_filter($request->input('ingredients') ?? []);

        BarMenu::create($validated);

        return redirect()->route('admin.bar-menu.index')->with('success', 'Drink item created successfully!');
    }

    public function show(BarMenu $barMenu)
    {
        return view('admin.bar-menu.show', ['barMenu' => $barMenu]);
    }

    public function edit(BarMenu $barMenu)
    {
        $categories = self::getCategories();
        $siteSettings = SiteSettings::first();
        return view('admin.bar-menu.edit', ['barMenu' => $barMenu, 'categories' => $categories, 'siteSettings' => $siteSettings]);
    }

    public function update(Request $request, BarMenu $barMenu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|in:beer,wine,spirits,cocktail,mocktail,soft_drink,coffee,tea',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'ingredients' => 'nullable|array',
            'alcohol_content' => 'nullable|numeric|min:0|max:100',
            'serving_size' => 'nullable|string|max:50',
            'preparation_time' => 'nullable|integer|min:0',
            'preparation_notes' => 'nullable|string',
            'is_alcoholic' => 'boolean',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'cost_price' => 'nullable|numeric|min:0',
        ]);

        $validated['is_alcoholic'] = $request->has('is_alcoholic');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['ingredients'] = array_filter($request->input('ingredients') ?? []);

        $barMenu->update($validated);

        return redirect()->route('admin.bar-menu.index')->with('success', 'Drink item updated successfully!');
    }

    public function destroy(BarMenu $barMenu)
    {
        $barMenu->delete();
        return redirect()->route('admin.bar-menu.index')->with('success', 'Drink item deleted successfully!');
    }
}
