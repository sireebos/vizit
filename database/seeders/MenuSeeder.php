<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'home',
                'label' => 'HOME',
                'url' => '#hero',
                'icon' => 'fas fa-home',
                'sort_order' => 1,
                'is_active' => true,
                'open_in_new_tab' => false,
            ],
            [
                'name' => 'stay',
                'label' => 'STAY',
                'url' => '#stay',
                'icon' => 'fas fa-bed',
                'sort_order' => 2,
                'is_active' => true,
                'open_in_new_tab' => false,
            ],
            [
                'name' => 'dine',
                'label' => 'DINE',
                'url' => '#dine',
                'icon' => 'fas fa-utensils',
                'sort_order' => 3,
                'is_active' => true,
                'open_in_new_tab' => false,
            ],
            [
                'name' => 'experience',
                'label' => 'EXPERIENCE',
                'url' => '#experience',
                'icon' => 'fas fa-star',
                'sort_order' => 4,
                'is_active' => true,
                'open_in_new_tab' => false,
            ],
            [
                'name' => 'events',
                'label' => 'EVENTS',
                'url' => '#events',
                'icon' => 'fas fa-calendar',
                'sort_order' => 5,
                'is_active' => true,
                'open_in_new_tab' => false,
            ],
            [
                'name' => 'admin',
                'label' => 'ADMIN',
                'url' => '/admin/dashboard',
                'icon' => 'fas fa-cog',
                'sort_order' => 6,
                'is_active' => true,
                'open_in_new_tab' => false,
                'css_class' => 'admin-link',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['name' => $menu['name']],
                $menu
            );
        }
    }
}
