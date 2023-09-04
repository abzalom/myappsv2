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
        Menu::truncate();
        SubMenu::truncate();
        $menus = [
            [
                'id' => '1',
                'name' => 'Home',
                'link' => '/',
                'current' => '',
                'roles' => 'admin,user,',
                'nomor' => 1,
                'sub_menus' => []
            ],
            [
                'id' => '2',
                'name' => 'Config',
                'link' => '/config',
                'current' => 'config/*',
                'roles' => 'admin,',
                'nomor' => 2,
                'sub_menus' => [
                    [
                        'sub_name' => 'Menus',
                        'sub_link' => '/app/menu',
                        'roles' => 'admin,',
                        'nomor' => 1
                    ],
                    [
                        'sub_name' => 'Tahun',
                        'sub_link' => '/tahun',
                        'roles' => 'admin,',
                        'nomor' => 2
                    ],
                    [
                        'sub_name' => 'Jadwal',
                        'sub_link' => '/jadwal',
                        'roles' => 'admin,bappeda,',
                        'nomor' => 19
                    ],
                ]
            ],
            [
                'id' => '3',
                'name' => 'RKPD',
                'link' => '/rkpd',
                'current' => 'rkpd/*',
                'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,eselon-2b,eselon-3b,eselon-4b,eselon-5a,',
                'nomor' => 7,
                'sub_menus' => [
                    [
                        'sub_name' => 'Ranwal',
                        'sub_link' => '/ranwal',
                        'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,eselon-2b,eselon-3b,eselon-4b,eselon-5a,',
                        'nomor' => 1
                    ],
                    [
                        'menu_id' => '3',
                        'sub_name' => 'Rancangan',
                        'sub_link' => '/rancangan',
                        'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,eselon-2b,eselon-3b,eselon-4b,eselon-5a,bappeda,',
                        'nomor' => 20
                    ],
                ]
            ],
            [
                'id' => '5',
                'name' => 'Referensi',
                'link' => '/referensi',
                'current' => 'referensi/*',
                'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,guest,eselon-2b,eselon-3b,eselon-4b,eselon-5a,',
                'nomor' => 4,
                'sub_menus' => [
                    [
                        'sub_name' => 'Nomenklatur',
                        'sub_link' => '/nomenklatur/urusan',
                        'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,guest,eselon-2b,eselon-3b,eselon-4b,eselon-5a,',
                        'nomor' => 1
                    ],
                    [
                        'sub_name' => 'Rekening Neraa',
                        'sub_link' => '/rekening/neraca',
                        'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,guest,eselon-2b,eselon-3b,eselon-4b,eselon-5a,',
                        'nomor' => 2
                    ],
                    [
                        'sub_name' => 'Rekening LRA',
                        'sub_link' => '/rekening/lra',
                        'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,guest,eselon-2b,eselon-3b,eselon-4b,eselon-5a,',
                        'nomor' => 3
                    ],
                    [
                        'sub_name' => 'Rekening LO',
                        'sub_link' => '/rekening/lo',
                        'roles' => 'admin,user,eselon-2a,eselon-3a,eselon-4a,staf,guest,eselon-2b,eselon-3b,eselon-4b,eselon-5a,',
                        'nomor' => 4
                    ],
                ]
            ],
            [
                'id' => '7',
                'name' => 'RJPMD',
                'link' => '/rpjmd',
                'current' => 'rpjmd/*',
                'roles' => 'admin,',
                'nomor' => 5,
                'sub_menus' => [
                    [
                        'menu_id' => '7',
                        'sub_name' => 'Periode',
                        'sub_link' => '/periode',
                        'roles' => 'admin,',
                        'nomor' => 1
                    ],
                ]
            ],
            [
                'id' => '8',
                'name' => 'Management',
                'link' => '/management',
                'current' => 'management/*',
                'roles' => 'admin,',
                'nomor' => 3,
                'sub_menus' => [
                    [
                        'sub_name' => 'Pegawai',
                        'sub_link' => '/pegawai/asn',
                        'roles' => 'admin,',
                        'nomor' => 1
                    ],
                    [
                        'sub_name' => 'Pejabat Sekda',
                        'sub_link' => '/pejabat/sekda',
                        'roles' => 'admin,',
                        'nomor' => 2
                    ],
                    [
                        'sub_name' => 'Perangkat Daerah',
                        'sub_link' => '/opd',
                        'roles' => 'admin,',
                        'nomor' => 3
                    ],
                    [
                        'sub_name' => 'Pendapatan Ranwal',
                        'sub_link' => '/pendapatan/ranwal',
                        'roles' => 'admin,',
                        'nomor' => 4
                    ],
                    [
                        'sub_name' => 'Pagu OPD',
                        'sub_link' => '/pagu',
                        'roles' => 'admin,',
                        'nomor' => 5
                    ],
                ]
            ],
            [
                'id' => '9',
                'name' => 'Renstra',
                'link' => '/renstra',
                'current' => 'renstra/*',
                'roles' => 'admin,eselon-2a,eselon-3a,eselon-2b,eselon-3b,bappeda,',
                'nomor' => 6,
                'sub_menus' => []
            ]
        ];

        foreach ($menus as $menu) {
            $query_menu = Menu::create([
                'id' => $menu['id'],
                'name' => $menu['name'],
                'link' => $menu['link'],
                'current' => $menu['current'],
                'roles' => $menu['roles'],
                'nomor' => $menu['nomor'],
            ]);
            if ($menu['sub_menus']) {
                foreach ($menu['sub_menus'] as $submenu) {
                    SubMenu::create([
                        'menu_id' => $query_menu->id,
                        'sub_name' => $submenu['sub_name'],
                        'sub_link' => $submenu['sub_link'],
                        'roles' => $submenu['roles'],
                        'nomor' => $submenu['nomor'],
                    ]);
                }
            }
        }
    }
}
