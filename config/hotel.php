<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Hotel Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains all the configuration options for the Vermon Hotel
    | & Bar Management System. These settings control various aspects of
    | the hotel operations.
    |
    */

    'name' => env('HOTEL_NAME', 'Kuwait Cabin Hotel Bar'),
    'address' => env('HOTEL_ADDRESS', '123 Main Street, City, Country'),
    'phone' => env('HOTEL_PHONE', '+1234567890'),
    'email' => env('HOTEL_EMAIL', 'info@vermonhotel.com'),
    'website' => env('HOTEL_WEBSITE', 'https://vermonhotel.com'),

    /*
    |--------------------------------------------------------------------------
    | Business Settings
    |--------------------------------------------------------------------------
    */
    'currency' => env('CURRENCY', 'USD'),
    'currency_symbol' => env('CURRENCY_SYMBOL', '$'),
    'tax_rate' => env('TAX_RATE', 10.00),
    'service_charge' => env('SERVICE_CHARGE', 5.00),

    /*
    |--------------------------------------------------------------------------
    | Booking Settings
    |--------------------------------------------------------------------------
    */
    'booking' => [
        'advance_days' => env('BOOKING_ADVANCE_DAYS', 365),
        'cancellation_hours' => env('CANCELLATION_HOURS', 24),
        'check_in_time' => env('CHECK_IN_TIME', '14:00'),
        'check_out_time' => env('CHECK_OUT_TIME', '11:00'),
        'auto_confirm' => false,
        'require_deposit' => true,
        'deposit_percentage' => 20,
    ],

    /*
    |--------------------------------------------------------------------------
    | Room Settings
    |--------------------------------------------------------------------------
    */
    'rooms' => [
        'floors' => ['Ground', '1st', '2nd', '3rd', '4th', '5th'],
        'statuses' => [
            'available' => 'Available',
            'occupied' => 'Occupied',
            'maintenance' => 'Under Maintenance',
            'cleaning' => 'Being Cleaned',
            'out_of_order' => 'Out of Order',
        ],
        'cleaning_time_minutes' => 30,
        'maintenance_reminder_days' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | Restaurant Settings
    |--------------------------------------------------------------------------
    */
    'restaurant' => [
        'categories' => [
            'appetizer' => 'Appetizers',
            'main_course' => 'Main Course',
            'dessert' => 'Desserts',
            'breakfast' => 'Breakfast',
            'lunch' => 'Lunch',
            'dinner' => 'Dinner',
        ],
        'order_statuses' => [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'preparing' => 'Preparing',
            'ready' => 'Ready',
            'served' => 'Served',
            'cancelled' => 'Cancelled',
        ],
        'auto_print_kot' => true,
        'preparation_buffer_minutes' => 5,
    ],

    /*
    |--------------------------------------------------------------------------
    | Bar Settings
    |--------------------------------------------------------------------------
    */
    'bar' => [
        'categories' => [
            'beer' => 'Beer',
            'wine' => 'Wine',
            'spirits' => 'Spirits',
            'cocktail' => 'Cocktails',
            'mocktail' => 'Mocktails',
            'soft_drink' => 'Soft Drinks',
            'coffee' => 'Coffee',
            'tea' => 'Tea',
        ],
        'auto_print_bot' => true,
        'age_verification_required' => true,
        'minimum_age' => 21,
    ],

    /*
    |--------------------------------------------------------------------------
    | Inventory Settings
    |--------------------------------------------------------------------------
    */
    'inventory' => [
        'categories' => [
            'food' => 'Food Items',
            'beverage' => 'Beverages',
            'supplies' => 'Supplies',
            'amenities' => 'Amenities',
            'maintenance' => 'Maintenance',
        ],
        'units' => [
            'kg' => 'Kilogram',
            'g' => 'Gram',
            'l' => 'Liter',
            'ml' => 'Milliliter',
            'piece' => 'Piece',
            'bottle' => 'Bottle',
            'pack' => 'Pack',
            'box' => 'Box',
        ],
        'low_stock_alert' => true,
        'expiry_alert_days' => 7,
        'auto_reorder' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Settings
    |--------------------------------------------------------------------------
    */
    'payments' => [
        'methods' => [
            'cash' => 'Cash',
            'card' => 'Credit/Debit Card',
            'bank_transfer' => 'Bank Transfer',
            'mobile_payment' => 'Mobile Payment',
            'cheque' => 'Cheque',
        ],
        'auto_generate_invoice' => true,
        'invoice_prefix' => 'INV',
        'payment_prefix' => 'PAY',
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Settings
    |--------------------------------------------------------------------------
    */
    'notifications' => [
        'channels' => ['email', 'sms', 'database', 'broadcast'],
        'events' => [
            'new_booking' => 'New Booking Created',
            'booking_confirmed' => 'Booking Confirmed',
            'check_in' => 'Guest Checked In',
            'check_out' => 'Guest Checked Out',
            'low_stock' => 'Low Stock Alert',
            'new_order' => 'New Order Received',
            'payment_received' => 'Payment Received',
            'maintenance_due' => 'Maintenance Due',
        ],
        'auto_send' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Report Settings
    |--------------------------------------------------------------------------
    */
    'reports' => [
        'types' => [
            'daily_summary' => 'Daily Summary Report',
            'revenue' => 'Revenue Report',
            'inventory' => 'Inventory Report',
            'staff_activity' => 'Staff Activity Report',
            'booking_performance' => 'Booking Performance Report',
            'guest_history' => 'Guest History Report',
        ],
        'auto_generate_daily' => true,
        'email_reports' => true,
        'report_recipients' => ['admin@vermonhotel.com'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    */
    'security' => [
        'session_timeout_minutes' => 120,
        'max_login_attempts' => 5,
        'lockout_duration_minutes' => 15,
        'require_2fa' => false,
        'password_expiry_days' => 90,
    ],

    /*
    |--------------------------------------------------------------------------
    | System Settings
    |--------------------------------------------------------------------------
    */
    'system' => [
        'timezone' => 'UTC',
        'date_format' => 'Y-m-d',
        'time_format' => 'H:i',
        'datetime_format' => 'Y-m-d H:i:s',
        'pagination_per_page' => 25,
        'backup_frequency' => 'daily',
        'log_retention_days' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Flags
    |--------------------------------------------------------------------------
    */
    'features' => [
        'online_booking' => true,
        'mobile_app' => true,
        'loyalty_program' => true,
        'multi_language' => false,
        'multi_currency' => false,
        'analytics' => true,
        'ai_recommendations' => true,
        'automated_pricing' => false,
    ],
];
