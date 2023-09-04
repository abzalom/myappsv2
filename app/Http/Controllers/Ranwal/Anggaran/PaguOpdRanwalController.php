<?php

namespace App\Http\Controllers\Ranwal\Anggaran;

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Models\PaguRanwalOpd;
use App\Http\Controllers\Controller;

class PaguOpdRanwalController extends Controller
{
    public function paguopd()
    {
        $opds = Opd::with([
            'paguranwals',
            'paguranwals.sumberdana',
        ])->withSum('paguranwals', 'jumlah')->orderBy('kode_opd')->get();
        return view('anggaran.ranwal.ranwal-paguopd', [
            'apps' => [
                'title' => 'Pagu OPD',
                'desc' => 'Rancangan Awal Pagu OPD Tahun ' . tahun(),
            ],
            'total' => PaguRanwalOpd::sum('jumlah'),
            'opds' => $opds,
            // 'pagutrashes' => OpdPagu::onlyTrashed()->orderBy('kode_opd')->get(),
            'pagutrashes' => PaguRanwalOpd::onlyTrashed()->orderBy('kode_opd')->get(),
        ]);
    }
}
