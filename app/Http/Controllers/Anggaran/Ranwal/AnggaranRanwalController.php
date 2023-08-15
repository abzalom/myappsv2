<?php

namespace App\Http\Controllers\Anggaran\Ranwal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anggaran\Ranwal\Pendapatan1AkunRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;
use App\Models\Opd;

class AnggaranRanwalController extends Controller
{
    public function pendapatan()
    {
        $akun = Pendapatan1AkunRanwal::with([
            'kelompoks' => fn ($q) => $q->orderBy('kode_kelompok', 'asc'),
            'kelompoks.jenises' => fn ($q) => $q->orderBy('kode_jenis', 'asc'),
            'kelompoks.jenises.objeks' => fn ($q) => $q->orderBy('kode_objek', 'asc'),
            'kelompoks.jenises.objeks.rincians' => fn ($q) => $q->orderBy('kode_rincian', 'asc'),
            'kelompoks.jenises.objeks.rincians.subrincians' => fn ($q) => $q->orderBy('kode_subrincian', 'asc'),
            'kelompoks.jenises.objeks.rincians.subrincians.uraians' => fn ($q) => $q->orderBy('kode_uraian', 'asc'),
        ])->where('kode_akun', 4)->first();
        return view('anggaran.ranwal.pendapatan', [
            'apps' => [
                'title' => 'Pendapatan',
                'desc' => 'Rancangan Awal Pendapatan Tahun ' . tahun(),
            ],
            'akun' => $akun,
            'uraians' => Pendapatan7UraianRanwal::onlyTrashed()->get(),
        ]);
    }
}
