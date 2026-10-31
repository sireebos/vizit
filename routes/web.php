<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\AssetController;

// Installation Wizard Routes (no middleware)
Route::prefix('install')->group(function () {
    Route::get('/', [InstallController::class, 'welcome'])->name('install.welcome');
    Route::get('/database', [InstallController::class, 'database'])->name('install.database');
    Route::post('/database', [InstallController::class, 'databaseStore'])->name('install.database.store');
    Route::get('/migration', [InstallController::class, 'migration'])->name('install.migration');
    Route::post('/migration', [InstallController::class, 'migrationRun'])->name('install.migration.run');
    Route::get('/admin', [InstallController::class, 'admin'])->name('install.admin');
    Route::post('/admin', [InstallController::class, 'adminStore'])->name('install.admin.store');
    Route::get('/site', [InstallController::class, 'site'])->name('install.site');
    Route::post('/site', [InstallController::class, 'siteStore'])->name('install.site.store');
    Route::get('/finish', [InstallController::class, 'finish'])->name('install.finish');
    Route::post('/complete', [InstallController::class, 'complete'])->name('install.complete');
});

Route::get('/', [HomeController::class, 'simple'])->name('home');
Route::get('/ikeja-residence', [HomeController::class, 'ikejaResidence'])->name('ikeja.residence');
Route::post('/check-availability', [HomeController::class, 'checkAvailability'])->name('check.availability');


// Simple pages
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/explore', [HomeController::class, 'explore'])->name('explore');
Route::get('/restaurant', [HomeController::class, 'restaurant'])->name('restaurant');
Route::get('/rooms', [HomeController::class, 'rooms'])->name('rooms');
Route::get('/room/{slug}', [HomeController::class, 'roomDetail'])->name('room.detail');
Route::get('/rooms-gallery', [HomeController::class, 'roomsGallery'])->name('rooms.gallery');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/terms-conditions', [HomeController::class, 'tandc'])->name('tandc');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

// Catalog Routes (Food, Drinks, Rooms with Barcodes)
Route::prefix('catalog')->group(function () {
    Route::get('/', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog.index');
    
    // Food
    Route::get('/food', [App\Http\Controllers\CatalogController::class, 'food'])->name('catalog.food');
    Route::get('/food/{id}', [App\Http\Controllers\CatalogController::class, 'showFood'])->name('catalog.food.show');
    
    // Drinks
    Route::get('/drinks', [App\Http\Controllers\CatalogController::class, 'drinks'])->name('catalog.drinks');
    Route::get('/drinks/{id}', [App\Http\Controllers\CatalogController::class, 'showDrink'])->name('catalog.drinks.show');
    
    // Rooms
    Route::get('/rooms', [App\Http\Controllers\CatalogController::class, 'rooms'])->name('catalog.rooms');
    Route::get('/rooms/{slug}', [App\Http\Controllers\CatalogController::class, 'showRoom'])->name('catalog.rooms.show');
    
    // Print Barcode
    Route::get('/print-barcode', [App\Http\Controllers\CatalogController::class, 'printBarcode'])->name('catalog.print-barcode');
    
    // QR Code
    Route::get('/qrcode', [App\Http\Controllers\CatalogController::class, 'qrcode'])->name('catalog.qrcode');
});

// Optional: preview the simple home without changing the current homepage
Route::get('/simple-home', [HomeController::class, 'simple'])->name('home.simple');

// Newsletter Subscription
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

// Serve assets directly from resources/ (css, js, img, fonts)
Route::get('/assets/css/{path}', [AssetController::class, 'css'])->where('path', '.*');
Route::get('/assets/js/{path}', [AssetController::class, 'js'])->where('path', '.*');
Route::get('/assets/img/{path}', [AssetController::class, 'img'])->where('path', '.*');
Route::get('/assets/fonts/{path}', [AssetController::class, 'fonts'])->where('path', '.*');

// Alias default login route to admin login so auth middleware redirects correctly
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin Authentication (session-based)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes (protected)
Route::get('/admin', function () {
    return auth()->check()
        ? redirect()->route('admin.home-page.edit')
        : redirect()->route('admin.login');
})->name('admin.index');

Route::prefix('admin')->middleware('auth')->group(function () {
    // Site Settings
    Route::get('/site-settings', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'edit'])->name('admin.site-settings.edit');
    Route::post('/site-settings', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'update'])->name('admin.site-settings.update');
    Route::post('/global-reset', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'globalReset'])->name('admin.global-reset');

    // Theme Settings
    Route::get('/theme-settings', [\App\Http\Controllers\Admin\ThemeSettingsController::class, 'edit'])->name('admin.theme-settings.edit');
    Route::post('/theme-settings', [\App\Http\Controllers\Admin\ThemeSettingsController::class, 'update'])->name('admin.theme-settings.update');
    Route::post('/theme-settings/reset', [\App\Http\Controllers\Admin\ThemeSettingsController::class, 'reset'])->name('admin.theme-settings.reset');

    // Home Page Editor
    Route::get('/home-page', [HomePageController::class, 'edit'])->name('admin.home-page.edit');
    Route::post('/home-page', [HomePageController::class, 'update'])->name('admin.home-page.update');
    Route::post('/home-page/reset', [HomePageController::class, 'reset'])->name('admin.home-page.reset');

    // About Page Editor
    Route::get('/about-page', [\App\Http\Controllers\Admin\AboutPageController::class, 'edit'])->name('admin.about-page.edit');
    Route::post('/about-page', [\App\Http\Controllers\Admin\AboutPageController::class, 'update'])->name('admin.about-page.update');
    Route::post('/about-page/reset', [\App\Http\Controllers\Admin\AboutPageController::class, 'reset'])->name('admin.about-page.reset');

    // Contact Page Editor
    Route::get('/contact-page', [\App\Http\Controllers\Admin\ContactPageController::class, 'edit'])->name('admin.contact-page.edit');
    Route::post('/contact-page', [\App\Http\Controllers\Admin\ContactPageController::class, 'update'])->name('admin.contact-page.update');
    Route::post('/contact-page/reset', [\App\Http\Controllers\Admin\ContactPageController::class, 'reset'])->name('admin.contact-page.reset');

    // Explore Page Editor
    Route::get('/explore-page', [\App\Http\Controllers\Admin\ExplorePageController::class, 'edit'])->name('admin.explore-page.edit');
    Route::post('/explore-page', [\App\Http\Controllers\Admin\ExplorePageController::class, 'update'])->name('admin.explore-page.update');
    Route::post('/explore-page/reset', [\App\Http\Controllers\Admin\ExplorePageController::class, 'reset'])->name('admin.explore-page.reset');

    // Restaurant Page Editor
    Route::get('/restaurant-page', [\App\Http\Controllers\Admin\RestaurantPageController::class, 'edit'])->name('admin.restaurant-page.edit');
    Route::post('/restaurant-page', [\App\Http\Controllers\Admin\RestaurantPageController::class, 'update'])->name('admin.restaurant-page.update');
    Route::post('/restaurant-page/reset', [\App\Http\Controllers\Admin\RestaurantPageController::class, 'reset'])->name('admin.restaurant-page.reset');

    // Rooms Page Editor
    Route::get('/rooms-page', [\App\Http\Controllers\Admin\RoomsPageController::class, 'edit'])->name('admin.rooms-page.edit');
    Route::post('/rooms-page', [\App\Http\Controllers\Admin\RoomsPageController::class, 'update'])->name('admin.rooms-page.update');
    Route::post('/rooms-page/reset', [\App\Http\Controllers\Admin\RoomsPageController::class, 'reset'])->name('admin.rooms-page.reset');

    // Rooms Gallery Page Editor
    Route::get('/rooms-gallery-page', [\App\Http\Controllers\Admin\RoomsGalleryPageController::class, 'edit'])->name('admin.rooms-gallery-page.edit');
    Route::post('/rooms-gallery-page', [\App\Http\Controllers\Admin\RoomsGalleryPageController::class, 'update'])->name('admin.rooms-gallery-page.update');
    Route::post('/rooms-gallery-page/reset', [\App\Http\Controllers\Admin\RoomsGalleryPageController::class, 'reset'])->name('admin.rooms-gallery-page.reset');

    // Search Page Editor
    Route::get('/search-page', [\App\Http\Controllers\Admin\SearchPageController::class, 'edit'])->name('admin.search-page.edit');
    Route::post('/search-page', [\App\Http\Controllers\Admin\SearchPageController::class, 'update'])->name('admin.search-page.update');
    Route::post('/search-page/reset', [\App\Http\Controllers\Admin\SearchPageController::class, 'reset'])->name('admin.search-page.reset');

    // Services Page Editor
    Route::get('/services-page', [\App\Http\Controllers\Admin\ServicesPageController::class, 'edit'])->name('admin.services-page.edit');
    Route::post('/services-page', [\App\Http\Controllers\Admin\ServicesPageController::class, 'update'])->name('admin.services-page.update');
    Route::post('/services-page/reset', [\App\Http\Controllers\Admin\ServicesPageController::class, 'reset'])->name('admin.services-page.reset');

    // Terms & Conditions Page Editor
    Route::get('/tandc-page', [\App\Http\Controllers\Admin\TandcPageController::class, 'edit'])->name('admin.tandc-page.edit');
    Route::post('/tandc-page', [\App\Http\Controllers\Admin\TandcPageController::class, 'update'])->name('admin.tandc-page.update');
    Route::post('/tandc-page/reset', [\App\Http\Controllers\Admin\TandcPageController::class, 'reset'])->name('admin.tandc-page.reset');

    // Image Upload
    Route::post('/upload-image', [\App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('admin.upload-image');

    // Room Types Management
    Route::resource('room-types', \App\Http\Controllers\Admin\RoomTypeController::class)->names([
        'index' => 'admin.room-types.index',
        'create' => 'admin.room-types.create',
        'store' => 'admin.room-types.store',
        'show' => 'admin.room-types.show',
        'edit' => 'admin.room-types.edit',
        'update' => 'admin.room-types.update',
        'destroy' => 'admin.room-types.destroy',
    ]);

    // Food Menu Management
    Route::resource('food-menu', \App\Http\Controllers\Admin\FoodMenuController::class)->names([
        'index' => 'admin.food-menu.index',
        'create' => 'admin.food-menu.create',
        'store' => 'admin.food-menu.store',
        'show' => 'admin.food-menu.show',
        'edit' => 'admin.food-menu.edit',
        'update' => 'admin.food-menu.update',
        'destroy' => 'admin.food-menu.destroy',
    ]);

    // Bar Menu Management (Drinks)
    Route::resource('bar-menu', \App\Http\Controllers\Admin\BarMenuController::class)->names([
        'index' => 'admin.bar-menu.index',
        'create' => 'admin.bar-menu.create',
        'store' => 'admin.bar-menu.store',
        'show' => 'admin.bar-menu.show',
        'edit' => 'admin.bar-menu.edit',
        'update' => 'admin.bar-menu.update',
        'destroy' => 'admin.bar-menu.destroy',
    ]);

    // Gallery Images Management
    Route::resource('gallery-images', \App\Http\Controllers\Admin\GalleryImageController::class)->names([
        'index' => 'admin.gallery-images.index',
        'create' => 'admin.gallery-images.create',
        'store' => 'admin.gallery-images.store',
        'show' => 'admin.gallery-images.show',
        'edit' => 'admin.gallery-images.edit',
        'update' => 'admin.gallery-images.update',
        'destroy' => 'admin.gallery-images.destroy',
    ]);

    // Subscribers Management
    Route::get('/subscribers', [\App\Http\Controllers\Admin\SubscriberController::class, 'index'])->name('admin.subscribers.index');
    Route::delete('/subscribers/{subscriber}', [\App\Http\Controllers\Admin\SubscriberController::class, 'destroy'])->name('admin.subscribers.destroy');
    Route::post('/subscribers/bulk-delete', [\App\Http\Controllers\Admin\SubscriberController::class, 'bulkDelete'])->name('admin.subscribers.bulk-delete');
    Route::get('/subscribers/export', [\App\Http\Controllers\Admin\SubscriberController::class, 'export'])->name('admin.subscribers.export');

    // Catalog Settings
    Route::get('/catalog-settings', [\App\Http\Controllers\Admin\CatalogSettingsController::class, 'edit'])->name('admin.catalog-settings.edit');
    Route::put('/catalog-settings', [\App\Http\Controllers\Admin\CatalogSettingsController::class, 'update'])->name('admin.catalog-settings.update');
    Route::post('/catalog-settings/reset', [\App\Http\Controllers\Admin\CatalogSettingsController::class, 'reset'])->name('admin.catalog-settings.reset');
});

// Demo API Routes (no authentication required for demo)
Route::prefix('demo/api/dashboard')->group(function () {
    Route::get('/overview', [App\Http\Controllers\DemoDashboardController::class, 'overview']);
    Route::get('/room-status', [App\Http\Controllers\DemoDashboardController::class, 'roomStatus']);
    Route::get('/revenue-analytics', [App\Http\Controllers\DemoDashboardController::class, 'revenueAnalytics']);
    Route::get('/recent-activities', [App\Http\Controllers\DemoDashboardController::class, 'recentActivities']);
    Route::get('/alerts', [App\Http\Controllers\DemoDashboardController::class, 'alerts']);
});
