<?php

namespace App\Http\Controllers\Rpjmd\Store;

use App\Models\RpjmdPeriode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RpjmdPeriodeStoreController extends Controller
{
    public function storeperiode(Request $request)
    {
        $data = $request->validate(
            [
                'awal' => 'required|date_format:Y',
                'akhir' => 'required|date_format:Y',
                'kdh' => 'required',
                'wkdh' => 'required',
            ],
            [
                'awal.required' => 'Tahun awal tidak boleh kosong!',
                'awal.date_format' => 'Format tahun tidak benar!',
                'akhir.required' => 'Tahun akhir tidak boleh kosong!',
                'akhir.date_format' => 'Format tahun tidak benar!',
                'kdh.required' => 'KDH tidak boleh kosong!',
                'wkdh.required' => 'WKDH tidak boleh kosong!',
            ]
        );

        $periode = RpjmdPeriode::create($data);
        return back()->with('pesan', 'Data periode jabatan kepala daerah dan wakil kepala daerah untuk ' . $periode->kdh . ' dan ' . $periode->wkdh . ' berhasil ditambahkan!');
    }

    public function updateperiode(Request $request)
    {
        $data = $request->validate(
            [
                'awal' => 'required|date_format:Y',
                'akhir' => 'required|date_format:Y',
                'kdh' => 'required',
                'wkdh' => 'required',
            ],
            [
                'awal.required' => 'Tahun awal tidak boleh kosong!',
                'awal.date_format' => 'Format tahun tidak benar!',
                'akhir.required' => 'Tahun akhir tidak boleh kosong!',
                'akhir.date_format' => 'Format tahun tidak benar!',
                'kdh.required' => 'KDH tidak boleh kosong!',
                'wkdh.required' => 'WKDH tidak boleh kosong!',
            ]
        );
        $periode = RpjmdPeriode::find($request->id);
        $periode->awal = $request->awal;
        $periode->akhir = $request->akhir;
        $periode->kdh = $request->kdh;
        $periode->wkdh = $request->wkdh;
        $periode->save();
        return redirect()->to(route('rpjmd.periode'))->with('pesan', 'Data periode jabatan kepala daerah dan wakil kepala daerah untuk ' . $periode->kdh . ' dan ' . $periode->wkdh . ' berhasil diupdate!');
    }

    public function activeperiode(Request $request)
    {
        RpjmdPeriode::where('active', true)->update(['active' => false]);
        $periode = RpjmdPeriode::find($request->periode_id);
        $periode->active = true;
        $periode->save();
        return back()->with('pesan', 'Data periode jabatan kepala daerah dan wakil kepala daerah untuk ' . $periode->kdh . ' dan ' . $periode->wkdh . ' berhasil diaktifkan!');
    }
}
