<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Booking Management
            'view_bookings', 'create_bookings', 'edit_bookings', 'delete_bookings',
            'checkin_guests', 'checkout_guests', 'cancel_bookings',

            // Guest Management
            'view_guests', 'create_guests', 'edit_guests', 'delete_guests',

            // Room Management
            'view_rooms', 'create_rooms', 'edit_rooms', 'delete_rooms',
            'manage_room_types', 'manage_room_prices',

            // Restaurant Management
            'view_restaurant_orders', 'create_restaurant_orders', 'edit_restaurant_orders',
            'manage_restaurant_menu', 'view_kitchen_orders',

            // Bar Management
            'view_bar_orders', 'create_bar_orders', 'edit_bar_orders',
            'manage_bar_menu', 'view_bar_orders_queue',

            // Inventory Management
            'view_inventory', 'create_inventory', 'edit_inventory', 'delete_inventory',
            'manage_suppliers', 'manage_purchase_orders', 'approve_stock',

            // Financial Management
            'view_payments', 'process_payments', 'refund_payments',
            'view_reports', 'generate_reports', 'view_analytics',

            // User Management
            'view_users', 'create_users', 'edit_users', 'delete_users',
            'manage_roles', 'manage_permissions',

            // System Management
            'manage_settings', 'backup_system', 'view_logs',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $receptionistRole = Role::create(['name' => 'Receptionist']);
        $barManagerRole = Role::create(['name' => 'Bar Manager']);
        $restaurantManagerRole = Role::create(['name' => 'Restaurant Manager']);
        $storeKeeperRole = Role::create(['name' => 'Store Keeper']);
        $accountantRole = Role::create(['name' => 'Accountant']);
        $customerRole = Role::create(['name' => 'Customer']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());

        $receptionistRole->givePermissionTo([
            'view_bookings', 'create_bookings', 'edit_bookings',
            'checkin_guests', 'checkout_guests',
            'view_guests', 'create_guests', 'edit_guests',
            'view_rooms', 'process_payments'
        ]);

        $barManagerRole->givePermissionTo([
            'view_bar_orders', 'create_bar_orders', 'edit_bar_orders',
            'manage_bar_menu', 'view_bar_orders_queue',
            'view_inventory', 'view_reports'
        ]);

        $restaurantManagerRole->givePermissionTo([
            'view_restaurant_orders', 'create_restaurant_orders', 'edit_restaurant_orders',
            'manage_restaurant_menu', 'view_kitchen_orders',
            'view_inventory', 'view_reports'
        ]);

        $storeKeeperRole->givePermissionTo([
            'view_inventory', 'create_inventory', 'edit_inventory',
            'manage_suppliers', 'manage_purchase_orders', 'approve_stock'
        ]);

        $accountantRole->givePermissionTo([
            'view_payments', 'process_payments',
            'view_reports', 'generate_reports', 'view_analytics'
        ]);

        // Create admin user
        $admin = User::create([
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'admin@vermonhotel.com',
            'password' => Hash::make('password'),
            'employee_id' => 'EMP001',
            'status' => 'active',
            'hire_date' => now(),
        ]);
        $admin->assignRole('Admin');

        // Create sample users
        $receptionist = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'receptionist@vermonhotel.com',
            'password' => Hash::make('password'),
            'employee_id' => 'EMP002',
            'status' => 'active',
            'hire_date' => now(),
        ]);
        $receptionist->assignRole('Receptionist');

        $barManager = User::create([
            'first_name' => 'Mike',
            'last_name' => 'Johnson',
            'email' => 'barmanager@vermonhotel.com',
            'password' => Hash::make('password'),
            'employee_id' => 'EMP003',
            'status' => 'active',
            'hire_date' => now(),
        ]);
        $barManager->assignRole('Bar Manager');
    }
}
