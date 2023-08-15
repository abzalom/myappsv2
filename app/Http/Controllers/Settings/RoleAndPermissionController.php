<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function roleandpermission(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $edit = Role::findByName($request->edit);
        }
        return view('settings.roles-permission', [
            'apps' => [
                'title' => 'Setting App',
                'desc' => 'Roles and Permission',
            ],
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'edit' => $edit,
        ]);
    }
}
