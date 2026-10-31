<?php

namespace App\Http\Controllers;

use App\Models\BarMenu;
use App\Models\CatalogSettings;
use App\Models\Menu;
use App\Models\RestaurantMenu;
use App\Models\RoomType;
use App\Models\SiteSettings;
use App\Models\WebsiteSettings;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Get common view data
     */
    protected function getCommonData()
    {
        return [
            'settings' => WebsiteSettings::getSettings(),
            'siteSettings' => SiteSettings::instance(),
            'catalogSettings' => CatalogSettings::instance(),
            'menus' => Menu::active()->ordered()->get(),
        ];
    }

    /**
     * Display main catalog page with all categories
     */
    public function index()
    {
        $drinks = BarMenu::available()->orderBy('sort_order')->get();
        $foods = RestaurantMenu::where('is_available', true)->orderBy('sort_order')->get();
        $rooms = RoomType::where('is_active', true)->orderBy('sort_order')->get();

        $drinksCount = $drinks->count();
        $foodCount = $foods->count();
        $roomsCount = $rooms->count();

        return view('catalog.index', array_merge(
            $this->getCommonData(),
            compact('drinks', 'foods', 'rooms', 'drinksCount', 'foodCount', 'roomsCount')
        ));
    }

    /**
     * Display all food items
     */
    public function food(Request $request)
    {
        $query = RestaurantMenu::where('is_available', true);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by dietary preferences
        if ($request->boolean('vegetarian')) {
            $query->where('is_vegetarian', true);
        }
        if ($request->boolean('vegan')) {
            $query->where('is_vegan', true);
        }

        $foods = $query->orderBy('category')->orderBy('sort_order')->get();
        
        $categories = RestaurantMenu::where('is_available', true)
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('catalog.food', array_merge(
            $this->getCommonData(),
            compact('foods', 'categories')
        ));
    }

    /**
     * Display single food item with barcode
     */
    public function showFood($id)
    {
        $food = RestaurantMenu::findOrFail($id);
        $barcode = 'FOOD' . str_pad($food->id, 6, '0', STR_PAD_LEFT);
        
        $relatedItems = RestaurantMenu::where('is_available', true)
            ->where('category', $food->category)
            ->where('id', '!=', $food->id)
            ->take(4)
            ->get();

        return view('catalog.food-detail', array_merge(
            $this->getCommonData(),
            compact('food', 'barcode', 'relatedItems')
        ));
    }

    /**
     * Display all drinks
     */
    public function drinks(Request $request)
    {
        $query = BarMenu::available();

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by alcoholic/non-alcoholic
        if ($request->has('alcoholic')) {
            if ($request->boolean('alcoholic')) {
                $query->alcoholic();
            } else {
                $query->nonAlcoholic();
            }
        }

        $drinks = $query->orderBy('category')->orderBy('sort_order')->get();
        
        $categories = BarMenu::available()
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('catalog.drinks', array_merge(
            $this->getCommonData(),
            compact('drinks', 'categories')
        ));
    }

    /**
     * Display single drink item with barcode
     */
    public function showDrink($id)
    {
        $drink = BarMenu::findOrFail($id);
        $barcode = $drink->barcode;
        
        $relatedItems = BarMenu::available()
            ->where('category', $drink->category)
            ->where('id', '!=', $drink->id)
            ->take(4)
            ->get();

        return view('catalog.drink-detail', array_merge(
            $this->getCommonData(),
            compact('drink', 'barcode', 'relatedItems')
        ));
    }

    /**
     * Display all rooms
     */
    public function rooms(Request $request)
    {
        $query = RoomType::where('is_active', true);

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }

        // Filter by occupancy
        if ($request->filled('guests')) {
            $query->where('max_occupancy', '>=', $request->guests);
        }

        $rooms = $query->orderBy('sort_order')->get();

        return view('catalog.rooms', array_merge(
            $this->getCommonData(),
            compact('rooms')
        ));
    }

    /**
     * Display single room with barcode
     */
    public function showRoom($slug)
    {
        $room = RoomType::where('slug', $slug)->firstOrFail();
        $barcode = 'ROOM' . str_pad($room->id, 6, '0', STR_PAD_LEFT);
        
        $relatedRooms = RoomType::where('is_active', true)
            ->where('id', '!=', $room->id)
            ->take(3)
            ->get();

        return view('catalog.room-detail', array_merge(
            $this->getCommonData(),
            compact('room', 'barcode', 'relatedRooms')
        ));
    }

    /**
     * Generate printable barcode page
     */
    public function printBarcode(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        
        switch ($type) {
            case 'food':
                $item = RestaurantMenu::findOrFail($id);
                $barcode = 'FOOD' . str_pad($item->id, 6, '0', STR_PAD_LEFT);
                $name = $item->name;
                $price = config('hotel.currency_symbol', '₦') . number_format($item->price, 2);
                break;
            case 'drink':
                $item = BarMenu::findOrFail($id);
                $barcode = $item->barcode;
                $name = $item->name;
                $price = $item->formatted_price;
                break;
            case 'room':
                $item = RoomType::findOrFail($id);
                $barcode = 'ROOM' . str_pad($item->id, 6, '0', STR_PAD_LEFT);
                $name = $item->name;
                $price = config('hotel.currency_symbol', '₦') . number_format($item->base_price, 2) . '/night';
                break;
            default:
                abort(404);
        }

        return view('catalog.print-barcode', array_merge(
            $this->getCommonData(),
            compact('item', 'barcode', 'name', 'price', 'type')
        ));
    }

    /**
     * Display QR code page for the catalog
     */
    public function qrcode()
    {
        $catalogUrl = route('catalog.index');
        
        return view('catalog.qrcode', array_merge(
            $this->getCommonData(),
            compact('catalogUrl')
        ));
    }
}
