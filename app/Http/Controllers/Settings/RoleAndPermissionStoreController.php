<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionStoreController extends Controller
{
    public function rolesave(Request $request)
    {
        $request->validate(
            [
                'role' => 'required',
            ],
            [
                'role.required' => 'role name tidak boleh kosong',
            ]
        );
        $role = Role::firstOrCreate([
            'name' => $request->role
        ]);
        if ($request->permission) {
            foreach ($request->permission as $value) {
                $permission = Permission::findOrCreate($value);
                $role->givePermissionTo($permission);
            }
        }
        return back()->with('pesan', 'Role ' . $role->name . ' telah ditambahkan');
    }

    public function roleupdate(Request $request)
    {
        $request->validate(
            [
                'role' => 'required',
            ],
            [
                'role.required' => 'role name tidak boleh kosong',
            ]
        );

        $role = Role::findByName($request->role_sebelum);
        $role->name = $request->role;
        $role->save();
        foreach ($role->permissions as $revolke) {
            $role->revokePermissionTo($revolke->name);
        }

        if ($request->permission) {
            foreach ($request->permission as $value) {
                $permission = Permission::findOrCreate($value);
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->to('/setting/roles')->with('pesan', 'Role ' . $role->name . ' telah diupdate');
    }
    public function roledestory(Request $request)
    {
        Role::findByName($request->role)->delete();
        return back()->with('pesan', 'Role telah dihapus');
    }
}
