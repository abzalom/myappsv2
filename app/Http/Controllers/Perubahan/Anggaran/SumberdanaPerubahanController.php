<?php

namespace App\Http\Controllers\Perubahan\Anggaran;

use App\Models\SumberDana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;

class SumberdanaPerubahanController extends Controller
{

    public function sumberdana()
    {
        $sumberdanas = SumberDana::with('perubahans')->whereHas('perubahans')->withSum('perubahans', 'jumlah')->get();
        // $deletes = SumberdanaPerubahan::where('deleted_at', '!=', null)->get();
        // $deletes = SumberdanaPerubahan::withTrashed()->get();
        // return $deletes;
        return view('anggaran.perubahan.perubahan-sumberdana', [
            'apps' => [
                'title' => 'Sumber Pendanaan',
                'desc' => 'Perubahan Sumber Pendanaan Tahun ' . tahun(),
            ],
            'deletes' => SumberdanaPerubahan::onlyTrashed()->get(),
            'total' => SumberdanaPerubahan::sum('jumlah'),
            'sumberdanas' => $sumberdanas,
        ]);
    }

    public function sumberdanaform(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $edit = SumberdanaPerubahan::find($request->edit);
        }
        return view('anggaran.perubahan.perubahan-sumberdana-input', [
            'apps' => [
                'title' => 'Sumber Pendanaan',
                'desc' => 'Perubahan Sumber Pendanaan Tahun ' . tahun(),
            ],
            'edit' => $edit,
            'sumberdanas' => SumberDana::where('input', true)->get(),
        ]);
    }

    public function sumberdanacetak()
    {
        return view('anggaran.perubahan.perubahan-sumberdana-cetak', [
            'sumberdanas' => SumberDana::with('perubahans')->whereHas('perubahans')->withSum('perubahans', 'jumlah')->get(),
        ]);
    }
}
