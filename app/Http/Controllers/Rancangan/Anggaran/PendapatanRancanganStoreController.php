<?php

namespace App\Http\Controllers\Rancangan\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Rancangan\PendapatanRancanganRequest;

class PendapatanRancanganStoreController extends Controller
{
    public function pendapatanstore(PendapatanRancanganRequest $request)
    {
        $query = $request->storerekening();
        $uraian = $request->storeuraian($query);
        return redirect()->back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format($uraian->jumlah, 2, ',', '.') . ',- berhasil ditambahkan!');
    }

    public function pendapatanupdate(PendapatanRancanganRequest $request)
    {
        // return gettype((float)$request->jumlah);
        $uraian = $request->updateuraian();
        // return $uraian;
        return back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format((int) $uraian->jumlah, 2, ',', '.') . ',- berhasil diupdata!');
    }

    public function pendapatandestroy(PendapatanRancanganRequest $request)
    {
        $request->destroyuraian();
        return back()->with('pesan', 'Pendapatan berhasil dihapus!');
    }

    public function pendapatanrestore(PendapatanRancanganRequest $request)
    {
        $uraian = $request->restoreuraian();
        return back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format($uraian->jumlah, 2, ',', '.') . ',- berhasil dikembalikan!');
    }
}
