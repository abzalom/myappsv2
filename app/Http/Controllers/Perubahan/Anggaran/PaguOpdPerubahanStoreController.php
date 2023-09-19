<?php

namespace App\Http\Controllers\Perubahan\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Perubahan\PaguOpdPerubahanRequest;

class PaguOpdPerubahanStoreController extends Controller
{
    public function paguopdstore(PaguOpdPerubahanRequest $request)
    {
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk dibagikan. silahkan ditambahkan menu Sumber Pendanaan!');
        }
        $store = $request->storepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil ditambahkan!');
    }

    public function paguopdupdate(PaguOpdPerubahanRequest $request)
    {
        // return $request->all();
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk diupdate. silahkan ditambahkan pada menu Sumber Pendanaan!');
        }
        $pagu = $request->updatepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil diupdate!');
    }

    public function paguopddestroy(PaguOpdPerubahanRequest $request)
    {
        $request->destorypagu();
        return redirect()->back()->with('pesan', 'Sumber dana berhasil dihapus!');
    }

    public function paguopdrestore(PaguOpdPerubahanRequest $request)
    {
        $pagu = $request->restorepagu();
        return redirect()->back()->with('pesan', 'Sumber dana  berhasil dikembalikan');
    }

    public function paguopdupload(Request $request)
    {
        return $request->all();
    }
}
