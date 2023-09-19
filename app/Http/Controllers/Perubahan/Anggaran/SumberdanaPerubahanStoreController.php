<?php

namespace App\Http\Controllers\Perubahan\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Perubahan\SumberdanaPerubahanRequest;

class SumberdanaPerubahanStoreController extends Controller
{
    public function sumberdanastore(SumberdanaPerubahanRequest $request)
    {
        $sumberdana = $request->storesumberdana();
        return redirect()->to('/perubahan/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana . ' - ' . $sumberdana->uraian . ' berhasil ditambahkan');
    }

    public function sumberdanaupdate(SumberdanaPerubahanRequest $request)
    {
        $sumberdana =  $request->updatesumbedana();
        return redirect()->to('/perubahan/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana . ' - ' . $sumberdana->uraian . ' berhasil diupdate');
    }

    public function sumberdanadestroy(SumberdanaPerubahanRequest $request)
    {
        $request->destroysumberdana();
        return redirect()->to('/perubahan/sumberdana')->with('pesan', 'Sumber Pendanaan berhasil diihapus');
    }

    public function sumberdanarestore(SumberdanaPerubahanRequest $request)
    {
        $sumberdana = $request->restoresumberdana();
        return redirect()->to('/perubahan/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana  . ' ' . $sumberdana->uraian . ' berhasil dikembalikan!');
    }
}
