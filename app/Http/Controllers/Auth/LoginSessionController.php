<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginSessionController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authsession();
        $login = $request->session();
        $login->regenerate();
        $user = User::find(auth()->user()->id);
        $tahun = $request->setTahun();
        if (!$tahun) {
            if ($user->hasRole(['admin', 'bappeda'])) {
                return redirect()->to(route('config.tahun'))->with('pesan', 'Tahun anggaran belum dibuat');
            }
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')->with('pesan', 'Tahun anggaran belum dibuat');
        }
        $request->periodeSession();
        return redirect()->intended('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
