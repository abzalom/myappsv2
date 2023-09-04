<?php

namespace App\Http\Controllers\Ranwal\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Ranwal\SumberdanaRanwalRequest;

class SumberdanaRanwalStoreController extends Controller
{
    public function sumberdanastore(SumberdanaRanwalRequest $request)
    {
        $sumberdana = $request->storesumberdana();
        return redirect()->to('/ranwal/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana . ' - ' . $sumberdana->uraian . ' berhasil ditambahkan');
    }

    public function sumberdanaupdate(SumberdanaRanwalRequest $request)
    {
        $sumberdana =  $request->updatesumbedana();
        return redirect()->to('/ranwal/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana . ' - ' . $sumberdana->uraian . ' berhasil diupdate');
    }

    public function sumberdanadestroy(SumberdanaRanwalRequest $request)
    {
        $request->destroysumberdana();
        return redirect()->to('/ranwal/sumberdana')->with('pesan', 'Sumber Pendanaan berhasil diihapus');
    }

    public function sumberdanarestore(SumberdanaRanwalRequest $request)
    {
        $sumberdana = $request->restoresumberdana();
        return redirect()->to('/ranwal/sumberdana')->with('pesan', 'Sumber Pendanaan ' . $sumberdana->kode_sumberdana  . ' ' . $sumberdana->uraian . ' berhasil dikembalikan!');
    }
}
