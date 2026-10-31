<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RestaurantOrder;
use App\Models\BarOrder;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoDashboardController extends Controller
{
    /**
     * Get dashboard overview data (demo version without auth)
     */
    public function overview(Request $request): JsonResponse
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Key metrics
        $totalRooms = Room::where('is_active', true)->count();
        $occupiedRooms = Room::where('status', 'occupied')->count();

        $metrics = [
            'total_rooms' => $totalRooms,
            'occupied_rooms' => $occupiedRooms,
            'available_rooms' => Room::where('status', 'available')->count(),
            'maintenance_rooms' => Room::where('status', 'maintenance')->count(),

            'total_guests' => Guest::count(),
            'vip_guests' => Guest::where('is_vip', true)->count(),
            'checked_in_today' => Booking::where('status', 'checked_in')
                ->whereDate('created_at', $today)->count(),
            'checking_out_today' => Booking::where('status', 'checked_in')
                ->whereDate('check_out_date', $today)->count(),

            'total_bookings_today' => Booking::whereDate('created_at', $today)->count(),
            'total_revenue_today' => Payment::where('status', 'completed')
                ->whereDate('created_at', $today)->sum('amount'),
            'total_revenue_month' => Payment::where('status', 'completed')
                ->whereBetween('created_at', [$thisMonth, now()])->sum('amount'),

            'pending_restaurant_orders' => 0, // Placeholder
            'pending_bar_orders' => 0, // Placeholder
        ];

        // Occupancy rate
        $metrics['occupancy_rate'] = $totalRooms > 0
            ? round(($occupiedRooms / $totalRooms) * 100, 2)
            : 0;

        // Revenue comparison
        $lastMonthRevenue = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$lastMonth, $thisMonth])->sum('amount');

        $metrics['revenue_growth'] = $lastMonthRevenue > 0
            ? round((($metrics['total_revenue_month'] - $lastMonthRevenue) / $lastMonthRevenue) * 100, 2)
            : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'metrics' => $metrics,
                'timestamp' => now(),
            ]
        ]);
    }

    /**
     * Get room status distribution
     */
    public function roomStatus(Request $request): JsonResponse
    {
        $roomStatus = Room::select('status', DB::raw('count(*) as count'))
            ->where('is_active', true)
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->status => $item->count];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'status_distribution' => $roomStatus,
            ]
        ]);
    }

    /**
     * Get revenue analytics
     */
    public function revenueAnalytics(Request $request): JsonResponse
    {
        $days = $request->get('days', 7);
        $startDate = Carbon::now()->subDays($days);

        // Generate sample daily revenue data
        $dailyRevenue = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dailyRevenue[] = [
                'date' => $date->toDateString(),
                'total' => rand(1000, 5000),
                'transactions' => rand(5, 25)
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'daily_revenue' => $dailyRevenue,
            ]
        ]);
    }

    /**
     * Get recent activities
     */
    public function recentActivities(Request $request): JsonResponse
    {
        $activities = [
            [
                'type' => 'booking',
                'title' => 'New Booking',
                'description' => 'Booking BK20251014001 for John Smith',
                'timestamp' => now()->subMinutes(15),
            ],
            [
                'type' => 'payment',
                'title' => 'Payment Received',
                'description' => 'Payment of $450.00 from Sarah Johnson',
                'timestamp' => now()->subMinutes(32),
            ],
            [
                'type' => 'checkin',
                'title' => 'Guest Check-in',
                'description' => 'Michael Brown checked into room 205',
                'timestamp' => now()->subHours(1),
            ],
            [
                'type' => 'checkout',
                'title' => 'Guest Check-out',
                'description' => 'Emily Davis checked out from room 301',
                'timestamp' => now()->subHours(2),
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'activities' => $activities,
            ]
        ]);
    }

    /**
     * Get alerts and notifications
     */
    public function alerts(Request $request): JsonResponse
    {
        $alerts = [
            [
                'type' => 'warning',
                'category' => 'overdue_checkout',
                'title' => 'Overdue Checkout',
                'message' => 'Guest in room 108 has overdue checkout',
                'created_at' => now()->subHours(3),
            ],
            [
                'type' => 'info',
                'category' => 'maintenance',
                'title' => 'Room Maintenance Required',
                'message' => 'Room 109 needs maintenance check',
                'created_at' => now()->subHours(5),
            ],
            [
                'type' => 'success',
                'category' => 'booking',
                'title' => 'High Occupancy',
                'message' => 'Hotel occupancy is at 85% - excellent performance!',
                'created_at' => now()->subHours(1),
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'alerts' => $alerts,
                'counts' => [
                    'total' => count($alerts),
                    'warning' => 1,
                    'info' => 1,
                    'success' => 1,
                    'error' => 0,
                ]
            ]
        ]);
    }
}
