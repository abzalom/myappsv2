<?php

namespace App\Http\Controllers\Management\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function home(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $id = decrypt($request->edit);
            $edit = User::find($id);
        }
        // return $edit;
        return view('management.user.user-home', [
            'apps' => [
                'title' => 'Users',
                'desc' => 'Kelolah Data Users',
            ],
            'users' => User::withTrashed()->whereNot('id', auth()->user()->id)->get(),
            'edit' => $edit,
            'roles' => Role::get(),
        ]);
    }
}
