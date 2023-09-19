<?php

namespace App\Imports;

use App\Models\A5Subkegiatan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Rkpd\Perubahan\Perubahan1Urusan;
use App\Models\Rkpd\Perubahan\Perubahan2Bidang;
use App\Models\Rkpd\Perubahan\Perubahan3Program;
use App\Models\Rkpd\Perubahan\Perubahan4Kegiatan;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use App\Models\Rkpd\Perubahan\Perubahan6Subkeluaran;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PerubahanRenjaAllImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model($row)
    {
        // dump($row);
        $datasub = A5Subkegiatan::with([
            'kegiatan',
            'kegiatan.program',
            'kegiatan.program.bidang',
            'kegiatan.program.bidang.urusan',
        ])->where('kode_subkegiatan', $row['kode_subkegiatan'])->first();
        if ($datasub) {
            $urusan = [
                'kode_opd' => $row['kode_opd'],
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'tahun' => tahun(),
            ];
            $create_urusan =  ['uraian' => $datasub->kegiatan->program->bidang->urusan->uraian,];


            $bidang = [
                'kode_opd' => $row['kode_opd'],
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
                'tahun' => tahun(),
            ];
            $create_bidang = ['uraian' => $datasub->kegiatan->program->bidang->uraian,];


            $program = [
                'kode_opd' => $row['kode_opd'],
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
                'kode_program' => $datasub->kegiatan->program->kode_program,
                'tahun' => tahun(),
            ];
            $create_program = ['uraian' => $datasub->kegiatan->program->uraian,];

            $kegiatan = [
                'kode_opd' => $row['kode_opd'],
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
                'kode_program' => $datasub->kegiatan->program->kode_program,
                'kode_kegiatan' => $datasub->kegiatan->kode_kegiatan,
                'tahun' => tahun(),
            ];
            $create_kegiatan = [
                'uraian' => $datasub->kegiatan->uraian,
                // 'capaian' => $row['capaian'] ? $row['capaian'] : '',
                // 'target_capaian' => $row['target_capaian'] ? str($row['target_capaian'])->replace(',', '.') : '',
                // 'satuan_capaian' => $row['satuan_capaian'] ? $row['satuan_capaian'] : '',
                // 'menjadi_capaian' => $row['capaian'] ? $row['capaian'] : '',
                // 'menjadi_target_capaian' => $row['target_capaian'] ? str($row['target_capaian'])->replace(',', '.') : '',
                // 'menjadi_satuan_capaian' => $row['satuan_capaian'] ? $row['satuan_capaian'] : '',
            ];

            $subkegiatan = [
                'kode_opd' => $row['kode_opd'],
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
                'kode_program' => $datasub->kegiatan->program->kode_program,
                'kode_kegiatan' => $datasub->kegiatan->kode_kegiatan,
                'kode_subkegiatan' => $datasub->kode_subkegiatan,
                'tahun' => tahun(),
            ];
            $create_subkegiatan = [
                'uraian' => $datasub->uraian,
                'kinerja' => $datasub->kinerja,
                'indikator' => $datasub->indikator,
                'satuan' => $datasub->satuan,
                'klasifikasi_belanja' => $datasub->klasifikasi_belanja,
                // semula
                'target_kinerja' => str($row['target_kinerja'])->replace(',', '.'),
                'satuan_kinerja' => $row['satuan_kinerja'],
                'target_indikator' => str($row['target_indikator'])->replace(',', '.'),
                'mulai' => $row['mulai'],
                'selesai' => $row['selesai'],
                'jenis' => $row['jenis'],
                // menjadi
                'menjadi_target_kinerja' => str($row['menjadi_target_kinerja'])->replace(',', '.'),
                'menjadi_satuan_kinerja' => $row['menjadi_satuan_kinerja'],
                'menjadi_target_indikator' => str($row['menjadi_target_indikator'])->replace(',', '.'),
                'menjadi_mulai' => $row['menjadi_mulai'],
                'menjadi_selesai' => $row['menjadi_selesai'],
                'menjadi_jenis' => $row['menjadi_jenis'],
            ];

            DB::beginTransaction();
            $input_urusan = Perubahan1Urusan::updateOrCreate($urusan, $create_urusan);
            $input_bidang = Perubahan2Bidang::updateOrCreate($bidang, $create_bidang);
            $input_program = Perubahan3Program::updateOrCreate($program, $create_program);
            $input_kegiatan = Perubahan4Kegiatan::updateOrCreate($kegiatan, $create_kegiatan);
            $subkeg = Perubahan5Subkegiatan::updateOrCreate($subkegiatan, $create_subkegiatan);
            DB::commit();

            if ($row['kode_subkeluaran'] !== null) {
                // $getSubKel = Perubahan6Subkeluaran::firstOrCreate(
                //     [
                //         'kode_opd' => $subkeg->kode_opd,
                //         'kode_urusan' => $subkeg->kode_urusan,
                //         'kode_bidang' => $subkeg->kode_bidang,
                //         'kode_program' => $subkeg->kode_program,
                //         'kode_kegiatan' => $subkeg->kode_kegiatan,
                //         'kode_subkegiatan' => $subkeg->kode_subkegiatan,
                //         'kode_subkeluaran' => $row['kode_subkeluaran'],
                //     ],
                //     [
                //         'uraian' => $row['uraian'],
                //         // semula
                //         'target' => str($row['target'])->replace(',', '.'),
                //         'satuan' => $row['satuan'],
                //         'anggaran' => str($row['anggaran'])->replace(',', '.'),
                //         'anggaran_maju' => str($row['anggaran_maju'])->replace(',', '.'),
                //         'sumberdana' => $row['sumberdana'],
                //         'lokasi' => $row['lokasi'],
                //         // menjadi
                //         'menjadi_target' => str($row['target'])->replace(',', '.'),
                //         'menjadi_satuan' => $row['satuan'],
                //         'menjadi_anggaran' => str($row['anggaran'])->replace(',', '.'),
                //         'menjadi_anggaran_maju' => str($row['anggaran_maju'])->replace(',', '.'),
                //         'menjadi_sumberdana' => $row['sumberdana'],
                //         'menjadi_lokasi' => $row['lokasi'],

                //         'tahun' => tahun(),
                //     ]
                // );

                $getSubKel = Perubahan6Subkeluaran::where(
                    [
                        'kode_opd' => $subkeg->kode_opd,
                        // 'kode_urusan' => $subkeg->kode_urusan,
                        // 'kode_bidang' => $subkeg->kode_bidang,
                        // 'kode_program' => $subkeg->kode_program,
                        // 'kode_kegiatan' => $subkeg->kode_kegiatan,
                        // 'kode_subkegiatan' => $subkeg->kode_subkegiatan,
                        'kode_subkeluaran' => $row['kode_subkeluaran'],
                        // 'uraian' => $row['uraian'],
                        // 'target' => str($row['target'])->replace(',', '.'),
                        // 'satuan' => $row['satuan'],
                        // 'anggaran' => str($row['anggaran'])->replace(',', '.'),
                        // 'anggaran_maju' => str($row['anggaran_maju'])->replace(',', '.'),
                        // 'sumberdana' => $row['sumberdana'],
                        // 'lokasi' => $row['lokasi'],
                    ],
                )->first();

                $input_subkel = false;
                if ($getSubKel) {
                    $getSubKel->menjadi_target = str($row['menjadi_target'])->replace(',', '.');
                    $getSubKel->menjadi_satuan = $row['menjadi_satuan'];
                    $getSubKel->menjadi_anggaran = str($row['menjadi_anggaran'])->replace(',', '.');
                    $getSubKel->menjadi_anggaran_maju = str($row['menjadi_anggaran_maju'])->replace(',', '.');
                    $getSubKel->menjadi_sumberdana = $row['menjadi_sumberdana'];
                    $getSubKel->menjadi_lokasi = $row['menjadi_lokasi'];
                    $input_subkel = $getSubKel->save();
                }
                if (!$getSubKel) {
                    $input_subkel = Perubahan6Subkeluaran::create(
                        [
                            'kode_opd' => $subkeg->kode_opd,
                            'kode_urusan' => $subkeg->kode_urusan,
                            'kode_bidang' => $subkeg->kode_bidang,
                            'kode_program' => $subkeg->kode_program,
                            'kode_kegiatan' => $subkeg->kode_kegiatan,
                            'kode_subkegiatan' => $subkeg->kode_subkegiatan,
                            'kode_subkeluaran' => $row['kode_subkeluaran'],
                            'uraian' => $row['uraian'],
                            // semula
                            'target' => str($row['target'])->replace(',', '.'),
                            'satuan' => $row['satuan'],
                            'anggaran' => str($row['anggaran'])->replace(',', '.'),
                            'anggaran_maju' => str($row['anggaran_maju'])->replace(',', '.'),
                            'sumberdana' => $row['sumberdana'],
                            'lokasi' => $row['lokasi'],
                            // menjadi
                            'menjadi_target' => str($row['menjadi_target'])->replace(',', '.'),
                            'menjadi_satuan' => $row['menjadi_satuan'],
                            'menjadi_anggaran' => str($row['menjadi_anggaran'])->replace(',', '.'),
                            'menjadi_anggaran_maju' => str($row['menjadi_anggaran_maju'])->replace(',', '.'),
                            'menjadi_sumberdana' => $row['menjadi_sumberdana'],
                            'menjadi_lokasi' => $row['menjadi_lokasi'],

                            'tahun' => tahun(),
                        ]
                    );
                }

                if (!$input_subkel) {
                    DB::rollBack();
                }
            }
            if (!$input_urusan or !$input_bidang or !$input_program or !$input_kegiatan or !$subkeg) {
                DB::rollBack();
            }
        }
    }

    public function chunkSize(): int
    {
        return 200;
    }
}
