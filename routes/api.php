<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Authentication routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Admin only routes
    Route::middleware('role:Admin')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
    });
    
    // Booking Management Routes
    Route::middleware('permission:view_bookings')->group(function () {
        Route::get('/bookings', function () {
            return response()->json(['message' => 'Bookings list']);
        });
    });
    
    // Guest Management Routes
    Route::middleware('permission:view_guests')->group(function () {
        Route::get('/guests', function () {
            return response()->json(['message' => 'Guests list']);
        });
    });
    
    // Room Management Routes
    Route::middleware('permission:view_rooms')->group(function () {
        Route::get('/rooms', function () {
            return response()->json(['message' => 'Rooms list']);
        });
    });
    
    // Restaurant Management Routes
    Route::middleware('permission:view_restaurant_orders')->group(function () {
        Route::get('/restaurant/orders', function () {
            return response()->json(['message' => 'Restaurant orders list']);
        });
    });
    
    // Bar Management Routes
    Route::middleware('permission:view_bar_orders')->group(function () {
        Route::get('/bar/orders', function () {
            return response()->json(['message' => 'Bar orders list']);
        });
    });
    
    // Inventory Management Routes
    Route::middleware('permission:view_inventory')->group(function () {
        Route::get('/inventory', function () {
            return response()->json(['message' => 'Inventory list']);
        });
    });
    
    // Financial Management Routes
    Route::middleware('permission:view_payments')->group(function () {
        Route::get('/payments', function () {
            return response()->json(['message' => 'Payments list']);
        });
    });
    
    // Reports Routes
    Route::middleware('permission:view_reports')->group(function () {
        Route::get('/reports', function () {
            return response()->json(['message' => 'Reports list']);
        });
    });
    
    // Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/overview', [App\Http\Controllers\Admin\DashboardController::class, 'overview']);
        Route::get('/room-status', [App\Http\Controllers\Admin\DashboardController::class, 'roomStatus']);
        Route::get('/booking-analytics', [App\Http\Controllers\Admin\DashboardController::class, 'bookingAnalytics']);
        Route::get('/revenue-analytics', [App\Http\Controllers\Admin\DashboardController::class, 'revenueAnalytics']);
        Route::get('/recent-activities', [App\Http\Controllers\Admin\DashboardController::class, 'recentActivities']);
        Route::get('/staff-performance', [App\Http\Controllers\Admin\DashboardController::class, 'staffPerformance']);
        Route::get('/alerts', [App\Http\Controllers\Admin\DashboardController::class, 'alerts']);
    });

    // User Management Routes (Admin only)
    Route::middleware('role:Admin')->group(function () {
        Route::get('/users', function () {
            return response()->json(['message' => 'Users list']);
        });

        Route::get('/roles', function () {
            return response()->json(['message' => 'Roles list']);
        });

        Route::get('/permissions', function () {
            return response()->json(['message' => 'Permissions list']);
        });
    });
});

// Health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'service' => 'Vizit Hotel & Suites API'
    ]);
});
