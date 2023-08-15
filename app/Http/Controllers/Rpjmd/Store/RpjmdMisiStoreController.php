<?php

namespace App\Http\Controllers\Rpjmd\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rpjmd\MisiRequest;
use App\Models\RpjmdMisi;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RpjmdMisiStoreController extends Controller
{
    public function storemisi(MisiRequest $request)
    {
        $misi = RpjmdMisi::create([
            'rpjmd_periode_id' => $request->periode_id,
            'rpjmd_visi_id' => $request->visi,
            'nomor' => $request->nomor,
            'misi' => $request->misi,
        ]);
        return back()->with('pesan', 'Misi nomor ' . $misi->nomor . ' telah di tambahkan');
    }

    public function updatemisi(MisiRequest $request)
    {
        $misi = RpjmdMisi::find($request->misi_id);
        $misi->rpjmd_visi_id = $request->visi;
        $misi->nomor = $request->nomor;
        $misi->misi = $request->misi;
        $misi->save();
        return redirect()->to(route('rpjmd.misi'))->with('pesan', 'Misi nomor ' . $misi->nomor . ' telah di tambahkan');
    }

    public function destorymisi(Request $request)
    {
        $misi = RpjmdMisi::find($request->id);
        $no = $misi->nomor;
        $misi->delete();
        return back()->with('pesan', 'Misi nomor ' . $no . ' telah di hapus');
    }
}
