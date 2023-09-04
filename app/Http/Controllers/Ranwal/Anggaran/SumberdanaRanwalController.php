<?php

namespace App\Http\Controllers\Ranwal\Anggaran;

use App\Models\SumberDana;
use Illuminate\Http\Request;
use App\Models\SumberdanaRanwal;
use App\Http\Controllers\Controller;

class SumberdanaRanwalController extends Controller
{

    public function sumberdana()
    {
        $sumberdanas = SumberDana::with('ranwals')->whereHas('ranwals')->withSum('ranwals', 'jumlah')->get();
        // $deletes = SumberdanaRanwal::where('deleted_at', '!=', null)->get();
        // $deletes = SumberdanaRanwal::withTrashed()->get();
        // return $sumberdanas;
        return view('anggaran.ranwal.ranwal-sumberdana', [
            'apps' => [
                'title' => 'Sumber Pendanaan',
                'desc' => 'Rancangan Awal Sumber Pendanaan Tahun ' . tahun(),
            ],
            'deletes' => SumberdanaRanwal::onlyTrashed()->get(),
            'total' => SumberdanaRanwal::sum('jumlah'),
            'sumberdanas' => $sumberdanas,
        ]);
    }

    public function sumberdanaform(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $edit = SumberdanaRanwal::find($request->edit);
        }
        return view('anggaran.ranwal.ranwal-sumberdana-input', [
            'apps' => [
                'title' => 'Sumber Pendanaan',
                'desc' => 'Rancangan Awal Sumber Pendanaan Tahun ' . tahun(),
            ],
            'edit' => $edit,
            'sumberdanas' => SumberDana::where('input', true)->get(),
        ]);
    }

    public function sumberdanacetak()
    {
        return view('anggaran.ranwal.ranwal-sumberdana-cetak', [
            'sumberdanas' => SumberDana::with('ranwals')->whereHas('ranwals')->withSum('ranwals', 'jumlah')->get(),
        ]);
    }
}
