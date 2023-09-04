<?php

namespace App\Imports;

use App\Models\A5Subkegiatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use App\Models\Rkpd\Ranwal\Ranwal2Bidang;
use App\Models\Rkpd\Ranwal\Ranwal3Program;
use App\Models\Rkpd\Ranwal\Ranwal4Kegiatan;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Rkpd\Ranwal\Ranwal5Subkegiatan;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class RanwalRenjaImport implements ToModel, WithHeadingRow
{

    public $opd;

    public function __construct($opd)
    {
        $this->opd = $opd;
    }


    public function model(array $row)
    {
        // if (!array_key_exists('capaian', $row)) {
        //     dd($row);
        // }
        $datasub = A5Subkegiatan::where('kode_subkegiatan', $row['kode_subkegiatan'])->first();
        if ($datasub) {
            $urusan = [
                'kode_opd' => $this->opd->kode_opd,
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'tahun' => tahun(),
            ];
            $create_urusan =  ['uraian' => $datasub->kegiatan->program->bidang->urusan->uraian,];


            $bidang = [
                'kode_opd' => $this->opd->kode_opd,
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
                'tahun' => tahun(),
            ];
            $create_bidang = ['uraian' => $datasub->kegiatan->program->bidang->uraian,];


            $program = [
                'kode_opd' => $this->opd->kode_opd,
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
                'kode_program' => $datasub->kegiatan->program->kode_program,
                'tahun' => tahun(),
            ];
            $create_program = ['uraian' => $datasub->kegiatan->program->uraian,];

            $kegiatan = [
                'kode_opd' => $this->opd->kode_opd,
                'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
                'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
                'kode_program' => $datasub->kegiatan->program->kode_program,
                'kode_kegiatan' => $datasub->kegiatan->kode_kegiatan,
                'tahun' => tahun(),
            ];
            $create_kegiatan = [
                'uraian' => $datasub->kegiatan->uraian,
                // 'capaian' => $row['capaian'],
                // 'target_capaian' => str($row['target_capaian'])->replace(',', '.'),
                // 'satuan_capaian' => $row['satuan_capaian'],
            ];

            $subkegiatan = [
                'kode_opd' => $this->opd->kode_opd,
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
                'target_kinerja' => str($row['target_kinerja'])->replace(',', '.'),
                'satuan_kinerja' => $row['satuan_kinerja'],
                'indikator' => $datasub->indikator,
                'target_indikator' => str($row['target_indikator'])->replace(',', '.'),
                'satuan' => $datasub->satuan,
                'mulai' => $row['mulai'],
                'selesai' => $row['selesai'],
                'klasifikasi_belanja' => $datasub->klasifikasi_belanja,
                'jenis' => $row['jenis'],
            ];

            DB::beginTransaction();
            $input_urusan = Ranwal1Urusan::firstOrCreate($urusan, $create_urusan);
            $input_bidang = Ranwal2Bidang::firstOrCreate($bidang, $create_bidang);
            $input_program = Ranwal3Program::firstOrCreate($program, $create_program);
            $input_kegiatan = Ranwal4Kegiatan::firstOrCreate($kegiatan, $create_kegiatan);
            $subkeg = Ranwal5Subkegiatan::firstOrCreate($subkegiatan, $create_subkegiatan);
            DB::commit();

            if ($row['kode_subkeluaran'] !== null) {
                $input_subkel = Ranwal6Subkeluaran::firstOrCreate(
                    [
                        'kode_opd' => $subkeg->kode_opd,
                        'kode_urusan' => $subkeg->kode_urusan,
                        'kode_bidang' => $subkeg->kode_bidang,
                        'kode_program' => $subkeg->kode_program,
                        'kode_kegiatan' => $subkeg->kode_kegiatan,
                        'kode_subkegiatan' => $subkeg->kode_subkegiatan,
                        'kode_subkeluaran' => $row['kode_subkeluaran'],
                    ],
                    [
                        'uraian' => $row['uraian'],
                        'target' => str($row['target'])->replace(',', '.'),
                        'satuan' => $row['satuan'],
                        'anggaran' => str($row['anggaran'])->replace(',', '.'),
                        'anggaran_maju' => str($row['anggaran_maju'])->replace(',', '.'),
                        'sumberdana' => $row['sumberdana'],
                        'lokasi' => $row['lokasi'],
                        'tahun' => tahun(),
                    ]
                );
                if (!$input_subkel) {
                    DB::rollBack();
                }
            }
            if (!$input_urusan or !$input_bidang or !$input_program or !$input_kegiatan or !$subkeg) {
                DB::rollBack();
            }
        }
    }
}
