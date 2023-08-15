<?php

namespace App\Http\Controllers\Management\Pegawai;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\PegawaiAsnRequest;
use Illuminate\Http\Request;

class PegawaiStoreController extends Controller
{
    public function pegawaiasnstore(PegawaiAsnRequest $request)
    {
        $request->storeasn();
        $pegawai = $request->createuserasn();
        return redirect()->to('/management/pegawai/asn')->with('pesan', 'Data pegawai dengan nip ' . $pegawai->nip . ' berhasil disimpan');
    }

    public function pegawaiasnudpate(PegawaiAsnRequest $request)
    {
        $pegawai = $request->updateasn();
        if ($request->opd && $request->jabatan) {
            $request->updateopdjababtan();
        }
        return back()->with('pesan', 'Data pegawai dengan nip ' . $pegawai->nip . ' berhasil diupdate');
    }
}
