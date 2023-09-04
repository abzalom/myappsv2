<?php

namespace Database\Seeders;

use App\Models\Peserta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // ['name' => 'create'],
            // ['name' => 'edit'],
            // ['name' => 'delete'],
            // ['name' => 'update'],
            ['name' => 'setting-app'],
            ['name' => 'add-user'],
            ['name' => 'update-user'],
            ['name' => 'delete-user'],
            ['name' => 'add-pegawai'],
            ['name' => 'input-renja'],
            ['name' => 'update-renja'],
            ['name' => 'delete-renja'],
            ['name' => 'lihat-renja'],
            ['name' => 'guest'],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $roles = [
            [
                'name' => 'admin',
                'permission' => [
                    'all'
                ]
            ],
            [
                'name' => 'bappeda',
                'permission' => [
                    'all'
                ]
            ],
            [
                'name' => 'user',
                'permission' => [
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'eselon-2a',
                'permission' => [
                    'add-pegawai',
                    'input-renja',
                    'update-renja',
                    'delete-renja',
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'eselon-2b',
                'permission' => [
                    'add-pegawai',
                    'input-renja',
                    'update-renja',
                    'delete-renja',
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'eselon-3a',
                'permission' => [
                    'input-renja',
                    'update-renja',
                    'delete-renja',
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'eselon-3b',
                'permission' => [
                    'input-renja',
                    'update-renja',
                    'delete-renja',
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'eselon-4a',
                'permission' => [
                    'input-renja',
                    'update-renja',
                    'delete-renja',
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'eselon-4b',
                'permission' => [
                    'input-renja',
                    'update-renja',
                    'delete-renja',
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'eselon-5a',
                'permission' => [
                    'input-renja',
                    'update-renja',
                    'delete-renja',
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'staf',
                'permission' => [
                    'lihat-renja',
                ]
            ],
            [
                'name' => 'guest',
                'permission' => [
                    'guest'
                ]
            ],
        ];
        foreach ($roles as $role) {
            if ($role['name'] == 'admin' or $role['name'] == 'bappeda') {
                Role::create(['name' => $role['name']])->givePermissionTo(Permission::all());
            } else {
                Role::create(['name' => $role['name']])->givePermissionTo($role['permission']);
            }
        }
        $user1 = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ]);
        $user1->assignRole('admin');

        $user2 = User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user'),
        ]);
        $user2->assignRole('user');

        $user3 = User::create([
            'name' => 'bappeda',
            'username' => 'bappeda',
            'email' => 'bappeda@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('bappeda'),
        ]);
        $user3->assignRole('bappeda');
    }
}
