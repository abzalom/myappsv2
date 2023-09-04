<?php

namespace App\Http\Controllers\Ranwal\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Ranwal\PaguOpdRanwalRequest;

class PaguOpdRanwalStoreController extends Controller
{
    public function paguopdstore(PaguOpdRanwalRequest $request)
    {
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk dibagikan. silahkan ditambahkan menu Sumber Pendanaan!');
        }
        $store = $request->storepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil ditambahkan!');
    }

    public function paguopdupdate(PaguOpdRanwalRequest $request)
    {
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk diupdate. silahkan ditambahkan pada menu Sumber Pendanaan!');
        }
        $pagu = $request->updatepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil diupdate!');
    }

    public function paguopddestroy(PaguOpdRanwalRequest $request)
    {
        $request->destorypagu();
        return redirect()->back()->with('pesan', 'Sumber dana berhasil dihapus!');
    }

    public function paguopdrestore(PaguOpdRanwalRequest $request)
    {
        $pagu = $request->restorepagu();
        return redirect()->back()->with('pesan', 'Sumber dana  berhasil dikembalikan');
    }

    public function paguopdupload(Request $request)
    {
        return $request->all();
    }
}
