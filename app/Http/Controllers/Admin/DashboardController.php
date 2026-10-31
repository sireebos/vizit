<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class DashboardController extends Controller
{
    /**
     * Get dashboard overview data
     */
    public function overview(Request $request): JsonResponse
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Key metrics
        $metrics = [
            'total_rooms' => Room::where('is_active', true)->count(),
            'occupied_rooms' => Room::where('status', 'occupied')->count(),
            'available_rooms' => Room::where('status', 'available')->count(),
            'maintenance_rooms' => Room::where('status', 'maintenance')->count(),

            'total_guests' => Guest::count(),
            'vip_guests' => Guest::where('is_vip', true)->count(),
            'checked_in_today' => Booking::where('status', 'checked_in')
                ->whereDate('checked_in_at', $today)->count(),
            'checking_out_today' => Booking::where('status', 'checked_in')
                ->whereDate('check_out_date', $today)->count(),

            'total_bookings_today' => Booking::whereDate('created_at', $today)->count(),
            'total_revenue_today' => Payment::where('status', 'completed')
                ->whereDate('created_at', $today)->sum('amount'),
            'total_revenue_month' => Payment::where('status', 'completed')
                ->whereBetween('created_at', [$thisMonth, now()])->sum('amount'),

            'pending_restaurant_orders' => RestaurantOrder::where('status', 'pending')->count(),
            'pending_bar_orders' => BarOrder::where('status', 'pending')->count(),
        ];

        // Occupancy rate
        $metrics['occupancy_rate'] = $metrics['total_rooms'] > 0
            ? round(($metrics['occupied_rooms'] / $metrics['total_rooms']) * 100, 2)
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

        $roomTypes = RoomType::with(['rooms' => function ($query) {
                $query->where('is_active', true);
            }])
            ->where('is_active', true)
            ->get()
            ->map(function ($type) {
                return [
                    'name' => $type->name,
                    'total' => $type->rooms->count(),
                    'available' => $type->rooms->where('status', 'available')->count(),
                    'occupied' => $type->rooms->where('status', 'occupied')->count(),
                    'maintenance' => $type->rooms->where('status', 'maintenance')->count(),
                    'cleaning' => $type->rooms->where('status', 'cleaning')->count(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'status_distribution' => $roomStatus,
                'room_types' => $roomTypes,
            ]
        ]);
    }

    /**
     * Get booking analytics
     */
    public function bookingAnalytics(Request $request): JsonResponse
    {
        $days = $request->get('days', 30);
        $startDate = Carbon::now()->subDays($days);

        // Daily bookings for the period
        $dailyBookings = Booking::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Booking status distribution
        $statusDistribution = Booking::select('status', DB::raw('count(*) as count'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->status => $item->count];
            });

        // Top room types by bookings
        $topRoomTypes = Booking::join('rooms', 'bookings.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select('room_types.name', DB::raw('count(*) as bookings'))
            ->where('bookings.created_at', '>=', $startDate)
            ->groupBy('room_types.id', 'room_types.name')
            ->orderBy('bookings', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'daily_bookings' => $dailyBookings,
                'status_distribution' => $statusDistribution,
                'top_room_types' => $topRoomTypes,
            ]
        ]);
    }

    /**
     * Get revenue analytics
     */
    public function revenueAnalytics(Request $request): JsonResponse
    {
        $days = $request->get('days', 30);
        $startDate = Carbon::now()->subDays($days);

        // Daily revenue
        $dailyRevenue = Payment::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total'),
                DB::raw('COUNT(*) as transactions')
            )
            ->where('status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Revenue by payment method
        $paymentMethods = Payment::select('payment_method', DB::raw('SUM(amount) as total'))
            ->where('status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->groupBy('payment_method')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->payment_method => $item->total];
            });

        // Revenue by source (bookings, restaurant, bar)
        $revenueBySource = [
            'bookings' => Payment::where('payable_type', 'App\Models\Booking')
                ->where('status', 'completed')
                ->where('created_at', '>=', $startDate)
                ->sum('amount'),
            'restaurant' => Payment::where('payable_type', 'App\Models\RestaurantOrder')
                ->where('status', 'completed')
                ->where('created_at', '>=', $startDate)
                ->sum('amount'),
            'bar' => Payment::where('payable_type', 'App\Models\BarOrder')
                ->where('status', 'completed')
                ->where('created_at', '>=', $startDate)
                ->sum('amount'),
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'daily_revenue' => $dailyRevenue,
                'payment_methods' => $paymentMethods,
                'revenue_by_source' => $revenueBySource,
            ]
        ]);
    }

    /**
     * Get recent activities
     */
    public function recentActivities(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 20);

        // Recent bookings
        $recentBookings = Booking::with(['guest', 'room.roomType', 'creator'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($booking) {
                return [
                    'type' => 'booking',
                    'title' => 'New Booking',
                    'description' => "Booking {$booking->booking_number} for {$booking->guest->full_name}",
                    'details' => [
                        'room' => $booking->room->room_number,
                        'room_type' => $booking->room->roomType->name,
                        'check_in' => $booking->check_in_date->format('M d, Y'),
                        'amount' => $booking->total_amount,
                    ],
                    'user' => $booking->creator->full_name,
                    'timestamp' => $booking->created_at,
                ];
            });

        // Recent payments
        $recentPayments = Payment::with(['guest'])
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($payment) {
                return [
                    'type' => 'payment',
                    'title' => 'Payment Received',
                    'description' => "Payment of {$payment->amount} from {$payment->guest->full_name}",
                    'details' => [
                        'amount' => $payment->amount,
                        'method' => $payment->payment_method,
                        'reference' => $payment->reference_number,
                    ],
                    'user' => $payment->processedBy->full_name ?? 'System',
                    'timestamp' => $payment->created_at,
                ];
            });

        // Merge and sort activities
        $activities = $recentBookings->concat($recentPayments)
            ->sortByDesc('timestamp')
            ->take($limit)
            ->values();

        return response()->json([
            'success' => true,
            'data' => [
                'activities' => $activities,
            ]
        ]);
    }

    /**
     * Get staff performance metrics
     */
    public function staffPerformance(Request $request): JsonResponse
    {
        $days = $request->get('days', 30);
        $startDate = Carbon::now()->subDays($days);

        // Top performing staff by bookings created
        $topBookingStaff = User::withCount(['createdBookings' => function ($query) use ($startDate) {
                $query->where('created_at', '>=', $startDate);
            }])
            ->having('created_bookings_count', '>', 0)
            ->orderBy('created_bookings_count', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->full_name,
                    'role' => $user->getRoleNames()->first(),
                    'bookings' => $user->created_bookings_count,
                ];
            });

        // Top performing staff by payments processed
        $topPaymentStaff = User::withCount(['processedPayments' => function ($query) use ($startDate) {
                $query->where('created_at', '>=', $startDate)
                      ->where('status', 'completed');
            }])
            ->having('processed_payments_count', '>', 0)
            ->orderBy('processed_payments_count', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->full_name,
                    'role' => $user->getRoleNames()->first(),
                    'payments' => $user->processed_payments_count,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'top_booking_staff' => $topBookingStaff,
                'top_payment_staff' => $topPaymentStaff,
            ]
        ]);
    }

    /**
     * Get alerts and notifications
     */
    public function alerts(Request $request): JsonResponse
    {
        $alerts = [];

        // Overdue checkouts
        $overdueCheckouts = Booking::with(['guest', 'room'])
            ->where('status', 'checked_in')
            ->where('check_out_date', '<', Carbon::today())
            ->get();

        foreach ($overdueCheckouts as $booking) {
            $alerts[] = [
                'type' => 'warning',
                'category' => 'overdue_checkout',
                'title' => 'Overdue Checkout',
                'message' => "Guest {$booking->guest->full_name} in room {$booking->room->room_number} has overdue checkout",
                'action_url' => "/admin/bookings/{$booking->id}",
                'created_at' => $booking->check_out_date,
            ];
        }

        // Rooms needing maintenance
        $maintenanceRooms = Room::with('roomType')
            ->where('status', 'maintenance')
            ->orWhere(function ($query) {
                $query->whereNotNull('last_maintenance_at')
                      ->where('last_maintenance_at', '<', Carbon::now()->subDays(30));
            })
            ->get();

        foreach ($maintenanceRooms as $room) {
            $alerts[] = [
                'type' => 'info',
                'category' => 'maintenance',
                'title' => 'Room Maintenance Required',
                'message' => "Room {$room->room_number} ({$room->roomType->name}) needs maintenance",
                'action_url' => "/admin/rooms/{$room->id}",
                'created_at' => $room->last_maintenance_at ?? $room->created_at,
            ];
        }

        // Low inventory items (placeholder - would need inventory models)
        // This would be implemented when inventory models are complete

        return response()->json([
            'success' => true,
            'data' => [
                'alerts' => collect($alerts)->sortByDesc('created_at')->values(),
                'counts' => [
                    'total' => count($alerts),
                    'warning' => collect($alerts)->where('type', 'warning')->count(),
                    'info' => collect($alerts)->where('type', 'info')->count(),
                    'error' => collect($alerts)->where('type', 'error')->count(),
                ]
            ]
        ]);
    }
}
