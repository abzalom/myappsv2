<?php

namespace App\Http\Controllers\Anggaran\Ranwal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaguOpdRequest;

class PaguOpdRanwalStoreController extends Controller
{
    public function paguopdstore(PaguOpdRequest $request)
    {
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk dibagikan. silahkan ditambahkan pada pendapatan!');
        }
        $request->storepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil ditambahkan!');
    }

    public function paguopdupdate(PaguOpdRequest $request)
    {
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk diupdate. silahkan ditambahkan pada pendapatan!');
        }
        $pagu = $request->updatepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil diupdate!');
    }

    public function paguopddestroy(PaguOpdRequest $request)
    {
        $request->destorypagu();
        return redirect()->back()->with('pesan', 'Sumber dana berhasil dihapus!');
    }

    public function paguopdrestore(PaguOpdRequest $request)
    {
        $pagu = $request->restorepagu();
        return redirect()->back()->with('pesan', 'Sumber dana  berhasil dikembalikan');
    }
}
