<?php

namespace App\Http\Controllers\Management\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\PangkatPegawai;
use App\Models\Pegawai\Pegawai;
use App\Models\Referensi\Jabatan;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * ASN
     */
    public function pegawaiasn()
    {
        $pegawais = Pegawai::with([
            'user' => fn ($q) => $q->withTrashed()
        ])
            ->withTrashed()
            ->get();
        return view('management.pegawai.asn.pegawai-asn', [
            'apps' => [
                'title' => 'Pegawai ASN',
                'desc' => 'Management Pegawai ASN',
            ],
            'pegawais' => $pegawais,
        ]);
    }

    public function pegawaiasncreate()
    {
        return view('management.pegawai.asn.pegawai-asn-create', [
            'apps' => [
                'title' => 'Pegawai ASN',
                'desc' => 'Input Data Pegawai ASN',
            ],
            'pangkats' => PangkatPegawai::get(),
        ]);
    }

    public function pegawaiasntagingopd($idpeg)
    {
        $pegawai = Pegawai::find($idpeg);
        if (!$pegawai) {
            return redirect()->to('/management/pegawai/asn')->with('pesan', 'Data pegawai tidak ditemukan');
        }
        // return $pegawai->opdpeg;
        return view('management.pegawai.asn.pegawai-asn-profile', [
            'apps' => [
                'title' => 'Pegawai ASN',
                'desc' => 'Input Data Pegawai ASN',
            ],
            'pangkats' => PangkatPegawai::get(),
            'opds' => Opd::orderBy('kode_opd')->get(),
            'pegawai' => $pegawai,
            'jabatans' => Jabatan::get(),
        ]);
    }




    /**
     * PPPK
     */

    public function pegawaipppk()
    {
        return view('management.pegawai.pppk.pegawai-pppk', [
            'apps' => [
                'title' => 'Pegawai PPK',
                'desc' => 'Management Pegawai PPK',
            ]
        ]);
    }
}
