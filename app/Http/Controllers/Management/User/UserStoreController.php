<?php

namespace App\Http\Controllers\Management\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\UserRequest;
use Illuminate\Http\Request;

class UserStoreController extends Controller
{
    public function store(UserRequest $request)
    {
        if ($request->aksi == 'create') {
            $user = $request->storeuser();
            return redirect()->back()->with('pesan', 'User dengan username : ' . $user->username . ' berhasil ditambahkan');
        }
        if ($request->aksi == 'update') {
            $user = $request->updateuser();
            return redirect()->to('user/setting/users')->with('pesan', 'User dengan username : ' . $user->username . ' berhasil diupdate');
        }
    }

    public function reset(UserRequest $request)
    {
        $user = $request->resetuser();
        return redirect()->back()->with('pesan', 'Password untuk user dengan username : ' . $user->username . ', telah direset menjadi standar adalah password');
    }

    public function lock(UserRequest $request)
    {
        $user = $request->lockuser();
        return redirect()->back()->with('pesan', 'User dengan username : ' . $user . ', telah dikunci');
    }

    public function unlock(UserRequest $request)
    {
        $user = $request->unlockuser();
        if (!$user['pegawai']) {
            return redirect()->back()->with('pesan', 'Maaf data pegawai untuk username : ' . $user['username'] . ', masih terkunci');
        }
        // return $user;
        return redirect()->back()->with('pesan', 'User dengan username : ' . $user['username'] . ', telah diaktifkan kembali');
    }
}
