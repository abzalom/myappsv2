<?php

namespace App\Http\Controllers\Anggaran\Ranwal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\PendapatanRequest;
use App\Http\Requests\PaguOpdRequest;

class AnggaranRanwalStoreController extends Controller
{
    public function pendapatanstore(PendapatanRequest $request)
    {
        $query = $request->storerekening();
        $uraian = $request->storeuraian($query);
        return redirect()->back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format($uraian->jumlah, 2, ',', '.') . ',- berhasil ditambahkan!');
    }

    public function pendapatanupdate(PendapatanRequest $request)
    {
        // return gettype((float)$request->jumlah);
        $uraian = $request->updateuraian();
        // return $uraian;
        return back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format((int) $uraian->jumlah, 2, ',', '.') . ',- berhasil diupdata!');
    }

    public function pendapatandestroy(PendapatanRequest $request)
    {
        $request->destroyuraian();
        return back()->with('pesan', 'Pendapatan berhasil dihapus!');
    }

    public function pendapatanrestore(PendapatanRequest $request)
    {
        $uraian = $request->restoreuraian();
        return back()->with('pesan', 'Pendapatan ' . $uraian->uraian . ' - ' . $uraian->kode_uraian . ' dengan alokasi sebesar Rp. ' . number_format($uraian->jumlah, 2, ',', '.') . ',- berhasil dikembalikan!');
    }
}
