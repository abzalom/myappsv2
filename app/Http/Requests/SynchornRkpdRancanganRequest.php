<?php

namespace App\Http\Requests;

use App\Models\PaguRanwalOpd;
use App\Models\PaguRancanganOpd;
use App\Models\SumberdanaRanwal;
use App\Models\SumberdanaRancangan;
use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use App\Models\Rkpd\Ranwal\Ranwal2Bidang;
use App\Models\Rkpd\Ranwal\Ranwal3Program;
use App\Models\Rkpd\Ranwal\Ranwal4Kegiatan;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Rkpd\Ranwal\Ranwal5Subkegiatan;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;
use App\Models\Rkpd\Rancangan\Rancangan1Urusan;
use App\Models\Rkpd\Rancangan\Rancangan2Bidang;
use App\Models\Rkpd\Rancangan\Rancangan3Program;
use App\Models\Rkpd\Rancangan\Rancangan4Kegiatan;
use App\Models\Rkpd\Rancangan\Rancangan5Subkegiatan;
use App\Models\Rkpd\Rancangan\Rancangan6Subkeluaran;
use App\Models\Anggaran\Ranwal\Pendapatan1AkunRanwal;
use App\Models\Anggaran\Rancangan\Pendapatan1AkunRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan3JenisRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan4ObjekRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan7UraianRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan5RincianRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan2KelompokRancangan;
use App\Models\Anggaran\Rancangan\Pendapatan6SubrincianRancangan;

class SynchornRkpdRancanganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function synchornPendapatanRanwalKeRancangan()
    {
        $pendapatans = Pendapatan1AkunRanwal::with([
            'kelompoks',
            'kelompoks.jenises',
            'kelompoks.jenises.objeks',
            'kelompoks.jenises.objeks.rincians.subrincians',
            'kelompoks.jenises.objeks.rincians.subrincians.uraians',
        ])->get();
        foreach ($pendapatans as $akun) {
            Pendapatan1AkunRancangan::updateOrCreate(
                [
                    'kode_akun' => $akun->kode_akun,
                    'tahun' => $akun->tahun,
                ],
                [
                    'uraian' => $akun->uraian,
                ]
            );
            foreach ($akun->kelompoks as $kelompok) {
                Pendapatan2KelompokRancangan::updateOrCreate(
                    [
                        'kode_akun' => $kelompok->kode_akun,
                        'kode_kelompok' => $kelompok->kode_kelompok,
                        'tahun' => $kelompok->tahun,
                    ],
                    [
                        'uraian' => $kelompok->uraian,
                    ]
                );
                foreach ($kelompok->jenises as $jenis) {
                    Pendapatan3JenisRancangan::updateOrCreate(
                        [
                            'kode_akun' => $jenis->kode_akun,
                            'kode_kelompok' => $jenis->kode_kelompok,
                            'kode_jenis' => $jenis->kode_jenis,
                            'tahun' => $jenis->tahun,
                        ],
                        [
                            'uraian' => $jenis->uraian,
                        ]
                    );
                    foreach ($jenis->objeks as $objek) {
                        Pendapatan4ObjekRancangan::updateOrCreate(
                            [
                                'kode_akun' => $objek->kode_akun,
                                'kode_kelompok' => $objek->kode_kelompok,
                                'kode_jenis' => $objek->kode_jenis,
                                'kode_objek' => $objek->kode_objek,
                                'tahun' => $objek->tahun,
                            ],
                            [
                                'uraian' => $objek->uraian,
                            ]
                        );
                        foreach ($objek->rincians as $rincian) {
                            Pendapatan5RincianRancangan::updateOrCreate(
                                [
                                    'kode_akun' => $rincian->kode_akun,
                                    'kode_kelompok' => $rincian->kode_kelompok,
                                    'kode_jenis' => $rincian->kode_jenis,
                                    'kode_objek' => $rincian->kode_objek,
                                    'kode_rincian' => $rincian->kode_rincian,
                                    'tahun' => $rincian->tahun,
                                ],
                                [
                                    'uraian' => $rincian->uraian,
                                ]
                            );
                            foreach ($rincian->subrincians as $subrincian) {
                                Pendapatan6SubrincianRancangan::updateOrCreate(
                                    [
                                        'kode_akun' => $subrincian->kode_akun,
                                        'kode_kelompok' => $subrincian->kode_kelompok,
                                        'kode_jenis' => $subrincian->kode_jenis,
                                        'kode_objek' => $subrincian->kode_objek,
                                        'kode_rincian' => $subrincian->kode_rincian,
                                        'kode_subrincian' => $subrincian->kode_subrincian,
                                        'tahun' => $subrincian->tahun,
                                    ],
                                    [
                                        'uraian' => $subrincian->uraian,
                                    ]
                                );
                                foreach ($subrincian->uraians as $uraian) {
                                    Pendapatan7UraianRancangan::updateOrCreate(
                                        [
                                            'kode_akun' => $uraian->kode_akun,
                                            'kode_kelompok' => $uraian->kode_kelompok,
                                            'kode_jenis' => $uraian->kode_jenis,
                                            'kode_objek' => $uraian->kode_objek,
                                            'kode_rincian' => $uraian->kode_rincian,
                                            'kode_subrincian' => $uraian->kode_subrincian,
                                            'kode_uraian' => $uraian->kode_uraian,
                                            'tahun' => $uraian->tahun,
                                        ],
                                        [
                                            'uraian' => $uraian->uraian,
                                            'jumlah' => $uraian->jumlah,
                                        ]
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function synchornSumberdanaranwalKeRancangan()
    {
        $sumberdanas = SumberdanaRanwal::get();
        foreach ($sumberdanas as $sumberdana) {
            SumberdanaRancangan::updateOrCreate(
                [
                    'kode_sumberdana' => $sumberdana->kode_sumberdana,
                    'nomor' => $sumberdana->nomor,
                    'kode_unik' => $sumberdana->kode_unik,
                    'tahun' => $sumberdana->tahun,
                ],
                [
                    'uraian' => $sumberdana->uraian,
                    'jumlah' => $sumberdana->jumlah,
                ]
            );
        }
    }

    public function synchornPaguRanwalKeRancangan()
    {
        $paguopds = PaguRanwalOpd::get();
        foreach ($paguopds as $paguopd) {
            PaguRancanganOpd::updateOrCreate(
                [
                    'kode_opd' => $paguopd->kode_opd,
                    'kode_sumberdana' => $paguopd->kode_sumberdana,
                    'kode_unik_sumberdana' => $paguopd->kode_unik_sumberdana,
                    'tahun' => $paguopd->tahun,
                ],
                [
                    'jumlah' => $paguopd->jumlah,
                ]
            );
        }
    }

    public function synchornRkpdRanwalKeRancangan()
    {
        $urusans = Ranwal1Urusan::get();
        foreach ($urusans as $urusan) {
            Rancangan1Urusan::updateOrCreate(
                [
                    'kode_opd' => $urusan->kode_opd,
                    'kode_urusan' => $urusan->kode_urusan,
                    'tahun' => $urusan->tahun,
                ],
                [
                    'uraian' => $urusan->uraian,
                ]
            );
        }

        $bidangs = Ranwal2Bidang::get();
        foreach ($bidangs as $bidang) {
            Rancangan2Bidang::updateOrCreate(
                [
                    'kode_opd' => $bidang->kode_opd,
                    'kode_urusan' => $bidang->kode_urusan,
                    'kode_bidang' => $bidang->kode_bidang,
                    'tahun' => $bidang->tahun,
                ],
                [
                    'uraian' => $bidang->uraian,
                ]
            );
        }

        $programs = Ranwal3Program::get();
        foreach ($programs as $program) {
            Rancangan3Program::updateOrCreate(
                [
                    'kode_opd' => $program->kode_opd,
                    'kode_urusan' => $program->kode_urusan,
                    'kode_bidang' => $program->kode_bidang,
                    'kode_program' => $program->kode_program,
                    'tahun' => $program->tahun,
                ],
                [
                    'uraian' => $program->uraian,
                ]
            );
        }

        $kegiatans = Ranwal4Kegiatan::get();
        foreach ($kegiatans as $kegiatan) {
            Rancangan4Kegiatan::updateOrCreate(
                [
                    'kode_opd' => $kegiatan->kode_opd,
                    'kode_urusan' => $kegiatan->kode_urusan,
                    'kode_bidang' => $kegiatan->kode_bidang,
                    'kode_program' => $kegiatan->kode_program,
                    'kode_kegiatan' => $kegiatan->kode_kegiatan,
                    'tahun' => $kegiatan->tahun,
                ],
                [
                    'uraian' => $kegiatan->uraian,
                ]
            );
        }

        $subkegiatans = Ranwal5Subkegiatan::get();
        foreach ($subkegiatans as $subkegiatan) {
            Rancangan5Subkegiatan::updateOrCreate(
                [
                    'kode_opd' => $subkegiatan->kode_opd,
                    'kode_urusan' => $subkegiatan->kode_urusan,
                    'kode_bidang' => $subkegiatan->kode_bidang,
                    'kode_program' => $subkegiatan->kode_program,
                    'kode_kegiatan' => $subkegiatan->kode_kegiatan,
                    'kode_subkegiatan' => $subkegiatan->kode_subkegiatan,
                    'tahun' => $subkegiatan->tahun,
                ],
                [
                    'uraian' => $subkegiatan->uraian,
                    'kinerja' => $subkegiatan->kinerja,
                    'target_kinerja' => $subkegiatan->target_kinerja,
                    'satuan_kinerja' => $subkegiatan->satuan_kinerja,
                    'indikator' => $subkegiatan->indikator,
                    'target_indikator' => $subkegiatan->target_indikator,
                    'satuan' => $subkegiatan->satuan,
                    'mulai' => $subkegiatan->mulai,
                    'selesai' => $subkegiatan->selesai,
                    'klasifikasi_belanja' => $subkegiatan->klasifikasi_belanja,
                    'jenis' => $subkegiatan->jenis,
                ]
            );
        }

        $subkeluarans = Ranwal6Subkeluaran::get();
        foreach ($subkeluarans as $subkeluaran) {
            Rancangan6Subkeluaran::updateOrCreate(
                [
                    'kode_opd' => $subkeluaran->kode_opd,
                    'kode_urusan' => $subkeluaran->kode_urusan,
                    'kode_bidang' => $subkeluaran->kode_bidang,
                    'kode_program' => $subkeluaran->kode_program,
                    'kode_kegiatan' => $subkeluaran->kode_kegiatan,
                    'kode_subkegiatan' => $subkeluaran->kode_subkegiatan,
                    'kode_subkeluaran' => $subkeluaran->kode_subkeluaran,
                    'tahun' => $subkeluaran->tahun,
                ],
                [
                    'uraian' => $subkeluaran->uraian,
                    'target' => $subkeluaran->target,
                    'satuan' => $subkeluaran->satuan,
                    'anggaran' => $subkeluaran->anggaran,
                    'ralisasi' => $subkeluaran->ralisasi,
                    'anggaran_maju' => $subkeluaran->anggaran_maju,
                    'sumberdana' => $subkeluaran->sumberdana,
                    'lokasi' => $subkeluaran->lokasi,
                ]
            );
        }
    }
}
