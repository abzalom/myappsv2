<?php

namespace App\Http\Controllers\Perubahan\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Perubahan\PendapatanPerubahanRequest;

class PendapatanPerubahanStoreController extends Controller
{
    public function pendapatanstore(PendapatanPerubahanRequest $request)
    {
        $query = $request->storerekening();
        $uraian = $request->storeuraian($query);
        return redirect()->back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format($uraian->jumlah, 2, ',', '.') . ',- berhasil ditambahkan!');
    }

    public function pendapatanupdate(PendapatanPerubahanRequest $request)
    {
        // return gettype((float)$request->jumlah);
        $uraian = $request->updateuraian();
        // return $uraian;
        return back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format((int) $uraian->jumlah, 2, ',', '.') . ',- berhasil diupdata!');
    }

    public function pendapatandestroy(PendapatanPerubahanRequest $request)
    {
        $request->destroyuraian();
        return back()->with('pesan', 'Pendapatan berhasil dihapus!');
    }

    public function pendapatanrestore(PendapatanPerubahanRequest $request)
    {
        $uraian = $request->restoreuraian();
        return back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format($uraian->jumlah, 2, ',', '.') . ',- berhasil dikembalikan!');
    }
}
