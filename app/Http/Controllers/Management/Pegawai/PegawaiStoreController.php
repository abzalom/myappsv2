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

    public function pegawaiasnlock(PegawaiAsnRequest $request)
    {
        $pegawai = $request->lockAsnAndUser();
        return back()->with('pesan', 'Data pegawai dengan nama : ' . $pegawai['nama'] . ' dan nip : ' . $pegawai['nip'] . ' telah dikunci akses');
    }

    public function pegawaiasnunlock(PegawaiAsnRequest $request)
    {
        $pegawai = $request->unlockAsnAndUser();
        return back()->with('pesan', 'Data pegawai dengan nama : ' . $pegawai['nama'] . ' dan nip : ' . $pegawai['nip'] . ' telah dibuka akses');
    }
}
