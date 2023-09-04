<?php

namespace App\Http\Controllers\Rancangan\Anggaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anggaran\Rancangan\PaguOpdRancanganRequest;
use Illuminate\Http\Request;

class PaguOpdRancanganStoreController extends Controller
{
    public function paguopdstore(PaguOpdRancanganRequest $request)
    {
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk dibagikan. silahkan ditambahkan menu Sumber Pendanaan!');
        }
        $store = $request->storepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil ditambahkan!');
    }

    public function paguopdupdate(PaguOpdRancanganRequest $request)
    {
        $sisah = $request->sisahsumberdana();
        if ($sisah['jumlah'] < $request->jumlah) {
            return redirect()->back()->with('pesan', 'Sumber dana ' . $sisah['uraian'] . ' hanya tersisa ' . number_format($sisah['jumlah'], 2, ',', '.') . ' untuk diupdate. silahkan ditambahkan pada menu Sumber Pendanaan!');
        }
        $pagu = $request->updatepagu();
        return redirect()->back()->with('pesan', 'Pagu berhasil diupdate!');
    }

    public function paguopddestroy(PaguOpdRancanganRequest $request)
    {
        $request->destorypagu();
        return redirect()->back()->with('pesan', 'Sumber dana berhasil dihapus!');
    }

    public function paguopdrestore(PaguOpdRancanganRequest $request)
    {
        $pagu = $request->restorepagu();
        return redirect()->back()->with('pesan', 'Sumber dana  berhasil dikembalikan');
    }

    public function paguopdupload(Request $request)
    {
        return $request->all();
    }
}
