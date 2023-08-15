<?php

namespace App\Http\Controllers\Configs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function profile(): View
    {
        return view('user.profile', [
            'apps' => [
                'title' => 'Profile',
                'desc' => 'Kelolah Profile ' . str(auth()->user()->username)->title(),
            ],
        ]);
    }

    function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . auth()->user()->id,
                'username' => 'required|unique:users,username,' . auth()->user()->id,
            ],
            [
                'name.required' => 'Nama tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.unique' => 'Email sudah digunakan!',
                'username.required' => 'Username tidak boleh kosong!',
                'username.unique' => 'Username sudah digunakan!',
            ]
        );

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = str($request->username)->replace(' ', '-');

        if ($request->password !== null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back()->with('message', 'Profile berhasil diupdate!');
    }
}
