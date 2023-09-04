<?php

namespace App\Http\Controllers\Rancangan\Anggaran;

use App\Http\Controllers\Controller;
use App\Models\Anggaran\Rancangan\Pendapatan1AkunRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan7UraianRancangan;
use Illuminate\Http\Request;

class PendapatanRancanganController extends Controller
{
    public function pendapatan()
    {
        $akun = Pendapatan1AkunRancangan::with([
            'kelompoks' => fn ($q) => $q->whereHas('jenises.objeks.rincians.subrincians.uraians')->orderBy('kode_kelompok', 'asc'),
            'kelompoks.jenises' => fn ($q) => $q->whereHas('objeks.rincians.subrincians.uraians')->orderBy('kode_jenis', 'asc'),
            'kelompoks.jenises.objeks' => fn ($q) => $q->whereHas('rincians.subrincians.uraians')->orderBy('kode_objek', 'asc'),
            'kelompoks.jenises.objeks.rincians' => fn ($q) => $q->whereHas('subrincians.uraians')->orderBy('kode_rincian', 'asc'),
            'kelompoks.jenises.objeks.rincians.subrincians' => fn ($q) => $q->whereHas('uraians')->orderBy('kode_subrincian', 'asc'),
            'kelompoks.jenises.objeks.rincians.subrincians.uraians' => fn ($q) => $q->orderBy('kode_uraian', 'asc'),
        ])
            ->whereHas('kelompoks.jenises.objeks.rincians.subrincians.uraians')
            ->where('kode_akun', 4)
            ->first();
        return view('anggaran.rancangan.rancangan-pendapatan', [
            'apps' => [
                'title' => 'Pendapatan',
                'desc' => 'Rancangan Awal Pendapatan Tahun ' . tahun(),
            ],
            'akun' => $akun,
            'uraians' => Pendapatan7UraianRancangan::onlyTrashed()->get(),
        ]);
    }
}
