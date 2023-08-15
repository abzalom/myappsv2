<?php

namespace App\Http\Controllers\Rpjmd\Store;

use App\Http\Controllers\Controller;
use App\Models\RpjmdVisi;
use Illuminate\Http\Request;

class RpjmdVisiStoreController extends Controller
{
    public function storevisi(Request $request)
    {
        $data = $request->validate(
            [
                'visi' => 'required',
            ],
            [
                'visi.required' => 'Visi tidak boleh kosong!'
            ]
        );
        $visi = RpjmdVisi::create([
            'rpjmd_periode_id' => $request->periode_id,
            'visi' => $request->visi,
        ]);
        return back()->with('pesan', 'Visi berhasil ditambahkan');
    }

    public function updatevisi(Request $request)
    {
        $data = $request->validate(
            [
                'visi' => 'required',
            ],
            [
                'visi.required' => 'Visi tidak boleh kosong!'
            ]
        );
        $visi = RpjmdVisi::find($request->visi_id);
        $visi->visi = $request->visi;
        $visi->save();
        return redirect()->to(route('rpjmd.visi'))->with('pesan', 'Visi berhasil diupdate');
    }

    public function destoryvisi(Request $request)
    {
        $visi = RpjmdVisi::find($request->id);
        $visi->delete();
        return back()->with('pesan', 'Visi berhasil dihapur');
    }
}
