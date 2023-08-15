<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\SubMenu;
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
                'name' => 'Home',
                'link' => '/',
                'current' => '/',
                'roles' => 'admin, user',
            ],
            [
                'name' => 'Config',
                'link' => '#',
                'current' => 'config/*',
                'roles' => 'admin',
            ],
        ];
        $submenus = [
            [
                'menu_id' => '2',
                'sub_name' => 'Menus',
                'sub_link' => '/config/app/menu',
                'roles' => 'admin,',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'name' => $menu['name'],
                'link' => $menu['link'],
                'current' => $menu['current'],
                'roles' => $menu['roles'],
            ]);
        }
        foreach ($submenus as $submenu) {
            SubMenu::create([
                'menu_id' => $submenu['menu_id'],
                'sub_name' => $submenu['sub_name'],
                'sub_link' => $submenu['sub_link'],
                'roles' => $submenu['roles'],
            ]);
        }
    }
}
