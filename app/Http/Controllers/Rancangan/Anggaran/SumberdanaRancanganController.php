<?php

namespace App\Http\Controllers\Rancangan\Anggaran;

use App\Http\Controllers\Controller;
use App\Models\SumberDana;
use App\Models\SumberdanaRancangan;
use Illuminate\Http\Request;

class SumberdanaRancanganController extends Controller
{

    public function sumberdana()
    {
        $sumberdanas = SumberDana::with('rancangans')->whereHas('rancangans')->withSum('rancangans', 'jumlah')->get();
        // $deletes = SumberdanaRancangan::where('deleted_at', '!=', null)->get();
        // $deletes = SumberdanaRancangan::withTrashed()->get();
        // return $deletes;
        return view('anggaran.rancangan.rancangan-sumberdana', [
            'apps' => [
                'title' => 'Sumber Pendanaan',
                'desc' => 'Rancangan Sumber Pendanaan Tahun ' . tahun(),
            ],
            'deletes' => SumberdanaRancangan::onlyTrashed()->get(),
            'total' => SumberdanaRancangan::sum('jumlah'),
            'sumberdanas' => $sumberdanas,
        ]);
    }

    public function sumberdanaform(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $edit = SumberdanaRancangan::find($request->edit);
        }
        return view('anggaran.rancangan.rancangan-sumberdana-input', [
            'apps' => [
                'title' => 'Sumber Pendanaan',
                'desc' => 'Rancangan Sumber Pendanaan Tahun ' . tahun(),
            ],
            'edit' => $edit,
            'sumberdanas' => SumberDana::where('input', true)->get(),
        ]);
    }

    public function sumberdanacetak()
    {
        return view('anggaran.rancangan.rancangan-sumberdana-cetak', [
            'sumberdanas' => SumberDana::with('rancangans')->whereHas('rancangans')->withSum('rancangans', 'jumlah')->get(),
        ]);
    }
}
