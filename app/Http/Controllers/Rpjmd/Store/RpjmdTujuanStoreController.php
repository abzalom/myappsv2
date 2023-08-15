<?php

namespace App\Http\Controllers\Rpjmd\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rpjmd\TujuanRequest;
use App\Models\RpjmdTujuan;
use Illuminate\Http\Request;

class RpjmdTujuanStoreController extends Controller
{
    public function storetujuan(TujuanRequest $request)
    {
        $request->store();
        return back()->with('pesan', 'Tujuan berhasil ditambahkan!');
    }

    public function updatetujuan(TujuanRequest $request)
    {
        $request->update();
        return back()->with('pesan', 'Tujuan berhasil diupdate!');
    }

    public function destorytujuan(Request $request)
    {
        $tujuan = RpjmdTujuan::find($request->tujuanid);
        $tujuan->delete();
        return back()->with('pesan', 'Tujuan berhasil dihapus!');
    }
}
