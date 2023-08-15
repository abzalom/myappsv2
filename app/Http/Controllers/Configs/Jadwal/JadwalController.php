<?php

namespace App\Http\Controllers\Configs\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function home()
    {
        return view('config.jadwal.config-jadwal', [
            'apps' => [
                'title' => 'Config | Jadwal',
                'desc' => 'Pengaturan Jadwal',
            ],
            'jadwal_rkpds' => DB::table('jadwal_rkpds')->where(
                [
                    'tahun' => session()->get('tahun'),
                ]
            )->orderByDesc('created_at')->get(),
        ]);
    }

    public function jadwalrkpd(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $edit = DB::table('jadwal_rkpds')->find($request->edit);
        }
        return view('config.jadwal.config-jadwal-rkpd', [
            'apps' => [
                'title' => 'Config | Jadwal RKPD',
                'desc' => 'Pengaturan Jadwal RKPD',
            ],
            'edit' => $edit,
        ]);
    }
}
