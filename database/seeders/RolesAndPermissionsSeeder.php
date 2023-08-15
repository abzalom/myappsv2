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
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'input renja']);

        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'user'])->givePermissionTo('input renja');

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
            'name' => 'daud',
            'username' => 'daud',
            'email' => 'daud@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('daud'),
        ]);
        $user3->assignRole('user');
    }
}
