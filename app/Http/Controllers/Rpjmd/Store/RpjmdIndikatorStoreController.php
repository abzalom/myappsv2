<?php

namespace App\Http\Controllers\Rpjmd\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rpjmd\IndikatorRequest;
use Illuminate\Http\Request;

class RpjmdIndikatorStoreController extends Controller
{
    public function storeindikator(IndikatorRequest $request)
    {
        $request->store();
        return back()->with('pesan', 'Indikator berhasil ditambahkan!');
    }

    public function updateindikator(IndikatorRequest $request)
    {
        $request->update();
        return back()->with('pesan', 'Indikator berhasil diupdate!');
    }

    public function destoryindikator(IndikatorRequest $request)
    {
        $request->destroy();
        return back()->with('pesan', 'Indikator berhasil dihapus!');
    }
}
