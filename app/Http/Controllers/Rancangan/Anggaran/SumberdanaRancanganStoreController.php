<?php

namespace App\Http\Controllers\Rancangan\Anggaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Rancangan\SumberdanaRancanganRequest;
use Illuminate\Http\Request;

class SumberdanaRancanganStoreController extends Controller
{
    public function sumberdanastore(SumberdanaRancanganRequest $request)
    {
        $sumberdana = $request->storesumberdana();
        return redirect()->to('/rancangan/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana . ' - ' . $sumberdana->uraian . ' berhasil ditambahkan');
    }

    public function sumberdanaupdate(SumberdanaRancanganRequest $request)
    {
        $sumberdana =  $request->updatesumbedana();
        return redirect()->to('/rancangan/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana . ' - ' . $sumberdana->uraian . ' berhasil diupdate');
    }

    public function sumberdanadestroy(SumberdanaRancanganRequest $request)
    {
        $request->destroysumberdana();
        return redirect()->to('/rancangan/sumberdana')->with('pesan', 'Sumber Pendanaan berhasil diihapus');
    }

    public function sumberdanarestore(SumberdanaRancanganRequest $request)
    {
        $sumberdana = $request->restoresumberdana();
        return redirect()->to('/rancangan/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana  . ' ' . $sumberdana->uraian . ' berhasil dikembalikan!');
    }
}
