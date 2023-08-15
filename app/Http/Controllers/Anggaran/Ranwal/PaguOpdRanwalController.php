<?php

namespace App\Http\Controllers\Anggaran\Ranwal;

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OpdPagu;
use App\Models\PaguRanwalOpd;

class PaguOpdRanwalController extends Controller
{
    public function paguopd()
    {
        return view('anggaran.ranwal.paguopd', [
            'apps' => [
                'title' => 'Pagu OPD',
                'desc' => 'Rancangan Awal Pagu OPD Tahun ' . tahun(),
            ],
            'opds' => Opd::orderBy('kode_opd')->get(),
            // 'pagutrashes' => OpdPagu::onlyTrashed()->orderBy('kode_opd')->get(),
            'pagutrashes' => PaguRanwalOpd::onlyTrashed()->orderBy('kode_opd')->get(),
        ]);
    }
}
