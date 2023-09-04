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
        return view('anggaran.rancangan.rancangan-paguopd', [
            'apps' => [
                'title' => 'Pagu OPD',
                'desc' => 'Rancangan Pagu OPD Tahun ' . tahun(),
            ],
            'total' => PaguRancanganOpd::sum('jumlah'),
            'opds' => Opd::with([
                'pagurancangans',
                'pagurancangans.sumberdana',
            ])->withSum('pagurancangans', 'jumlah')->orderBy('kode_opd')->get(),
            // 'pagutrashes' => OpdPagu::onlyTrashed()->orderBy('kode_opd')->get(),
            'pagutrashes' => PaguRancanganOpd::onlyTrashed()->orderBy('kode_opd')->get(),
        ]);
    }
}
