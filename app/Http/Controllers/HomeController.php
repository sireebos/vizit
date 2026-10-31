<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteSettings;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\RestaurantMenu;
use App\Models\GalleryImage;
use App\Models\Menu;
use App\Models\HomePageSettings;
use App\Models\SiteSettings;
use App\Models\ContactPageSettings;
use App\Models\ExplorePageSettings;
use App\Models\RestaurantPageSettings;
use App\Models\RoomsPageSettings;
use App\Models\RoomsGalleryPageSettings;
use App\Models\SearchPageSettings;
use App\Models\ServicesPageSettings;
use App\Models\TandcPageSettings;

class HomeController extends Controller
{
    public function index()
    {
        $settings = WebsiteSettings::getSettings();
        $menus = Menu::active()->ordered()->get();

        // Get room types with available rooms
        $roomTypes = RoomType::with(['rooms' => function($query) {
            $query->where('is_active', true);
        }])
        ->where('is_active', true)
        ->orderBy('base_price')
        ->get();

        // Get featured menu items
        $featuredMenuItems = RestaurantMenu::where('is_featured', true)
            ->where('is_available', true)
            ->limit(6)
            ->get();

        // Gallery images
        $galleryImages = GalleryImage::active()->ordered()->get();

        return view('welcome', compact('settings', 'roomTypes', 'featuredMenuItems', 'menus', 'galleryImages'));
    }

    // Ikeja Residence replica page
    public function ikejaResidence()
    {
        $settings = WebsiteSettings::getSettings();
        $menus = Menu::active()->ordered()->get();

        $roomTypes = RoomType::with(['rooms' => function($query) {
            $query->where('is_active', true);
        }])
        ->where('is_active', true)
        ->orderBy('base_price')
        ->get();

        $featuredMenuItems = RestaurantMenu::where('is_featured', true)
            ->where('is_available', true)
            ->limit(6)
            ->get();

        return view('ikeja', compact('settings', 'roomTypes', 'featuredMenuItems', 'menus'));
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
        ]);

        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $guests = $request->guests;

        // Get available room types
        $availableRoomTypes = RoomType::whereHas('rooms', function($query) use ($checkIn, $checkOut) {
            $query->where('is_active', true)
                  ->where('status', 'available')
                  ->whereDoesntHave('bookings', function($bookingQuery) use ($checkIn, $checkOut) {
                      $bookingQuery->where('status', '!=', 'cancelled')
                                   ->where(function($dateQuery) use ($checkIn, $checkOut) {
                                       $dateQuery->whereBetween('check_in_date', [$checkIn, $checkOut])
                                                ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                                                ->orWhere(function($overlapQuery) use ($checkIn, $checkOut) {
                                                    $overlapQuery->where('check_in_date', '<=', $checkIn)
                                                               ->where('check_out_date', '>=', $checkOut);
                                                });
                                   });
                  });
        })
        ->where('max_occupancy', '>=', $guests)
        ->with(['rooms' => function($query) use ($checkIn, $checkOut) {
            $query->where('is_active', true)
                  ->where('status', 'available')
                  ->whereDoesntHave('bookings', function($bookingQuery) use ($checkIn, $checkOut) {
                      $bookingQuery->where('status', '!=', 'cancelled')
                                   ->where(function($dateQuery) use ($checkIn, $checkOut) {
                                       $dateQuery->whereBetween('check_in_date', [$checkIn, $checkOut])
                                                ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                                                ->orWhere(function($overlapQuery) use ($checkIn, $checkOut) {
                                                    $overlapQuery->where('check_in_date', '<=', $checkIn)
                                                               ->where('check_out_date', '>=', $checkOut);
                                                });
                                   });
                  });
        }])
        ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'available_room_types' => $availableRoomTypes,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => $guests,
                'nights' => \Carbon\Carbon::parse($checkIn)->diffInDays($checkOut)
            ]
        ]);
    }

    public function about()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $about = \App\Models\AboutPageSettings::first();
        if (!$about) {
            $about = \App\Models\AboutPageSettings::create([
                'seo_title' => 'About Us - Kuwait Cabin Hotel Bar',
                'seo_description' => 'Learn more about Kuwait Cabin Hotel Bar',
                'sections' => [],
                'content' => [],
            ]);
        }
        return view('about', compact('settings', 'siteSettings', 'menus', 'about'));
    }

    public function simple()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $home = HomePageSettings::getCurrent();
        return view('home', compact('settings', 'siteSettings', 'menus', 'home'));
    }

    public function contact()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $contact = ContactPageSettings::first();
        if (!$contact) {
            $contact = ContactPageSettings::create([
                'seo_title' => 'Contact Us - Kuwait Cabin Hotel Bar',
                'seo_description' => 'Get in touch with Kuwait Cabin Hotel Bar',
                'sections' => [],
                'content' => [],
            ]);
        }
        return view('contact', compact('settings', 'siteSettings', 'menus', 'contact'));
    }

    public function explore()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $page = ExplorePageSettings::first();
        if (!$page) {
            $page = ExplorePageSettings::create([
                'seo_title' => 'Explore',
                'seo_description' => 'Explore our hotel',
                'sections' => [],
                'content' => [],
            ]);
        }
        
        // Get room types from database for rooms section
        $roomTypes = RoomType::where('is_active', true)->orderBy('sort_order')->take(3)->get();
        
        // Get services page settings for services banner section
        $servicesPage = ServicesPageSettings::first();
        
        return view('explore', compact('settings', 'siteSettings', 'menus', 'page', 'roomTypes', 'servicesPage'));
    }

    public function restaurant()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $page = RestaurantPageSettings::first();
        if (!$page) {
            $page = RestaurantPageSettings::create([
                'seo_title' => 'Restaurant',
                'seo_description' => 'Our restaurant',
                'sections' => [],
                'content' => [],
            ]);
        }
        $menuItems = RestaurantMenu::where('is_available', true)->orderBy('sort_order')->get();
        return view('restaurant', compact('settings', 'siteSettings', 'menus', 'page', 'menuItems'));
    }

    public function rooms(Request $request)
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $page = RoomsPageSettings::first();
        if (!$page) {
            $page = RoomsPageSettings::create([
                'seo_title' => 'Our Rooms',
                'seo_description' => 'View our rooms',
                'sections' => [],
                'content' => [],
            ]);
        }
        
        // Get search parameters
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $guests = $request->input('guests', 1);
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        
        // Calculate total guests from adults + children if provided (from parallax form)
        if ($adults > 0 || $children > 0) {
            $guests = max($guests, $adults + $children);
        }
        
        // Build query for room types
        $query = RoomType::where('is_active', true);
        
        // Filter by guest capacity if provided
        if ($guests && $guests > 0) {
            $query->where('max_occupancy', '>=', $guests);
        }
        
        // Filter by availability if dates are provided
        if ($checkIn && $checkOut) {
            // Parse dates - handle various formats
            try {
                $checkInDate = \Carbon\Carbon::parse($checkIn)->format('Y-m-d');
                $checkOutDate = \Carbon\Carbon::parse($checkOut)->format('Y-m-d');
                
                // Only include room types that have at least one available room for these dates
                $query->whereHas('rooms', function($roomQuery) use ($checkInDate, $checkOutDate) {
                    $roomQuery->where('is_active', true)
                              ->where('status', 'available')
                              ->whereDoesntHave('bookings', function($bookingQuery) use ($checkInDate, $checkOutDate) {
                                  $bookingQuery->where('status', '!=', 'cancelled')
                                               ->where(function($dateQuery) use ($checkInDate, $checkOutDate) {
                                                   $dateQuery->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                                                            ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                                                            ->orWhere(function($overlapQuery) use ($checkInDate, $checkOutDate) {
                                                                $overlapQuery->where('check_in_date', '<=', $checkInDate)
                                                                           ->where('check_out_date', '>=', $checkOutDate);
                                                            });
                                               });
                              });
                });
            } catch (\Exception $e) {
                // If date parsing fails, just ignore date filter
            }
        }
        
        $roomTypes = $query->orderBy('sort_order')->get();
        
        // If no rooms match the criteria, show all available rooms
        $noMatchFound = false;
        $hasSearch = $checkIn || $checkOut || $guests > 1;
        if ($roomTypes->count() == 0 && $hasSearch) {
            $noMatchFound = true;
            $roomTypes = RoomType::where('is_active', true)->orderBy('sort_order')->get();
        }
        
        // Calculate search info for display
        $searchInfo = null;
        if ($hasSearch) {
            $searchInfo = [
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => $guests,
                'has_search' => true,
                'no_match_found' => $noMatchFound,
            ];
        }
        
        return view('rooms', compact('settings', 'siteSettings', 'menus', 'page', 'roomTypes', 'searchInfo'));
    }

    public function roomDetail($slug)
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $roomType = RoomType::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $menuItems = RestaurantMenu::where('is_available', true)->orderBy('sort_order')->get();
        $relatedRooms = RoomType::where('is_active', true)->where('id', '!=', $roomType->id)->orderBy('sort_order')->take(3)->get();
        $page = RoomsPageSettings::first();
        return view('room-detail', compact('settings', 'siteSettings', 'menus', 'roomType', 'menuItems', 'relatedRooms', 'page'));
    }

    public function roomsGallery()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $page = RoomsGalleryPageSettings::first();
        if (!$page) {
            $page = RoomsGalleryPageSettings::create([
                'seo_title' => 'Room Gallery',
                'seo_description' => 'View our room gallery',
                'sections' => [],
                'content' => [],
            ]);
        }
        return view('rooms-gallery', compact('settings', 'siteSettings', 'menus', 'page'));
    }

    public function search(Request $request)
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $page = SearchPageSettings::first();
        if (!$page) {
            $page = SearchPageSettings::create([
                'seo_title' => 'Search Rooms',
                'seo_description' => 'Search for available rooms',
                'sections' => [],
                'content' => [],
            ]);
        }
        
        // Get search parameters
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $adults = $request->input('adults', 0);
        $children = $request->input('children', 0);
        $maxPrice = $request->input('max_price');
        $amenities = $request->input('amenities', []);
        
        // Calculate total guests
        $guests = $adults + $children;
        if ($guests == 0) $guests = 1;
        
        // Build query for room types
        $query = RoomType::where('is_active', true);
        
        // Filter by guest capacity
        if ($guests > 1) {
            $query->where('max_occupancy', '>=', $guests);
        }
        
        // Filter by max price
        if ($maxPrice && $maxPrice > 0) {
            $query->where('base_price', '<=', $maxPrice * 1000); // Convert to actual price (assuming slider is in thousands)
        }
        
        // Filter by availability if dates are provided
        if ($checkIn && $checkOut) {
            try {
                $checkInDate = \Carbon\Carbon::parse($checkIn)->format('Y-m-d');
                $checkOutDate = \Carbon\Carbon::parse($checkOut)->format('Y-m-d');
                
                $query->whereHas('rooms', function($roomQuery) use ($checkInDate, $checkOutDate) {
                    $roomQuery->where('is_active', true)
                              ->where('status', 'available')
                              ->whereDoesntHave('bookings', function($bookingQuery) use ($checkInDate, $checkOutDate) {
                                  $bookingQuery->where('status', '!=', 'cancelled')
                                               ->where(function($dateQuery) use ($checkInDate, $checkOutDate) {
                                                   $dateQuery->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                                                            ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                                                            ->orWhere(function($overlapQuery) use ($checkInDate, $checkOutDate) {
                                                                $overlapQuery->where('check_in_date', '<=', $checkInDate)
                                                                           ->where('check_out_date', '>=', $checkOutDate);
                                                            });
                                               });
                              });
                });
            } catch (\Exception $e) {
                // Ignore date parsing errors
            }
        }
        
        // Filter by amenities if provided
        if (!empty($amenities)) {
            $query->where(function($q) use ($amenities) {
                foreach ($amenities as $amenity) {
                    $q->orWhere('amenities', 'LIKE', '%' . $amenity . '%');
                }
            });
        }
        
        $roomTypes = $query->orderBy('base_price')->get();
        
        // If no rooms match the criteria, show all available rooms
        $noMatchFound = false;
        if ($roomTypes->count() == 0 && $searchInfo['has_search'] ?? false) {
            $noMatchFound = true;
            $roomTypes = RoomType::where('is_active', true)->orderBy('base_price')->get();
        }
        
        // Get all unique amenities from all room types for the filter
        $allRoomTypes = RoomType::where('is_active', true)->get();
        $allAmenities = [];
        foreach ($allRoomTypes as $rt) {
            if (!empty($rt->amenities) && is_array($rt->amenities)) {
                foreach ($rt->amenities as $amenity) {
                    $amenity = trim($amenity);
                    if (!empty($amenity) && !in_array($amenity, $allAmenities)) {
                        $allAmenities[] = $amenity;
                    }
                }
            }
        }
        sort($allAmenities);
        
        // Get price range for the slider
        $minPrice = RoomType::where('is_active', true)->min('base_price') ?? 10000;
        $maxPriceAvailable = RoomType::where('is_active', true)->max('base_price') ?? 500000;
        
        // Search info for display
        $searchInfo = [
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'adults' => $adults,
            'children' => $children,
            'max_price' => $maxPrice,
            'amenities' => $amenities,
            'has_search' => $checkIn || $checkOut || $adults > 0 || $children > 0 || $maxPrice,
            'no_match_found' => $noMatchFound,
        ];
        
        // Filter data for the sidebar
        $filterData = [
            'amenities' => $allAmenities,
            'min_price' => $minPrice,
            'max_price' => $maxPriceAvailable,
        ];
        
        return view('search', compact('settings', 'siteSettings', 'menus', 'page', 'roomTypes', 'searchInfo', 'filterData'));
    }

    public function services()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $page = ServicesPageSettings::first();
        if (!$page) {
            $page = ServicesPageSettings::create([
                'seo_title' => 'Services',
                'seo_description' => 'Our services',
                'sections' => [],
                'content' => [],
            ]);
        }
        return view('services', compact('settings', 'siteSettings', 'menus', 'page'));
    }

    public function tandc()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $page = TandcPageSettings::first();
        if (!$page) {
            $page = TandcPageSettings::create([
                'seo_title' => 'Terms & Conditions',
                'seo_description' => 'Terms and conditions',
                'sections' => [],
                'content' => [],
            ]);
        }
        return view('tandc', compact('settings', 'siteSettings', 'menus', 'page'));
    }

    public function gallery()
    {
        $settings = WebsiteSettings::getSettings();
        $siteSettings = SiteSettings::instance();
        $menus = Menu::active()->ordered()->get();
        $images = \App\Models\GalleryImage::active()->ordered()->get();
        return view('gallery', compact('settings', 'siteSettings', 'menus', 'images'));
    }
}
