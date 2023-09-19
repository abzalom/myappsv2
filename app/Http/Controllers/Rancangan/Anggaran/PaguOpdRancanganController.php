<?php

namespace App\Http\Controllers\Rancangan\Anggaran;

use App\Models\Opd;
use App\Models\OpdPagu;
use Illuminate\Http\Request;
use App\Models\PaguRancanganOpd;
use App\Http\Controllers\Controller;

class PaguOpdRancanganController extends Controller
{
    public function paguopd()
    {
        $opds = Opd::with([
            'pagurancangans',
            'pagurancangans.sumberdana',
        ])->withSum('pagurancangans', 'jumlah')->orderBy('kode_opd')->get();
        return view('anggaran.rancangan.rancangan-paguopd', [
            'apps' => [
                'title' => 'Pagu OPD',
                'desc' => 'Rancangan Pagu OPD Tahun ' . tahun(),
            ],
            'total' => PaguRancanganOpd::whereHas('opd')->sum('jumlah'),
            'opds' => $opds,
            'pagutrashes' => PaguRancanganOpd::onlyTrashed()->whereHas('opd')->orderBy('kode_opd')->get(),
        ]);
    }
}
