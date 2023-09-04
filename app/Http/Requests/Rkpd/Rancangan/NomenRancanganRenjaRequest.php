<?php

namespace App\Http\Requests\Rkpd\Rancangan;

use App\Models\A5Subkegiatan;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Rkpd\Rancangan\Rancangan1Urusan;
use App\Models\Rkpd\Rancangan\Rancangan2Bidang;
use App\Models\Rkpd\Rancangan\Rancangan3Program;
use App\Models\Rkpd\Rancangan\Rancangan4Kegiatan;
use App\Models\Rkpd\Rancangan\Rancangan5Subkegiatan;

class NomenRancanganRenjaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->aksi == 'create') {
            return [
                'bidang' => 'required',
                'program' => 'required',
                'capaian' => 'required',
                'target_capaian' => 'required',
                'satuan_capaian' => 'required',
                'kegiatan' => 'required',
                'target_kinerja' => 'required',
                'satuan_kinerja' => 'required',
                'subkegiatan' => 'required',
                'target_indikator' => 'required',
                'mulai' => 'required',
                'selesai' => 'required',
                'jenis' => 'required',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'capaian' => 'required',
                'target_capaian' => 'required',
                'satuan_capaian' => 'required',
                'target_kinerja' => 'required',
                'satuan_kinerja' => 'required',
                'target_indikator' => 'required',
                'mulai' => 'required',
                'selesai' => 'required',
                'jenis' => 'required',
            ];
        }
        return [];
    }
    public function messages(): array
    {
        if ($this->aksi == 'create') {
            return [
                'bidang' => 'bidang tidak boleh kosong!',
                'program' => 'program tidak boleh kosong!',
                'capaian' => 'capaian tidak boleh kosong!',
                'target_capaian' => 'target_capaian tidak boleh kosong!',
                'satuan_capaian' => 'satuan_capaian tidak boleh kosong!',
                'kegiatan' => 'kegiatan tidak boleh kosong!',
                'target_kinerja' => 'target_hasil tidak boleh kosong!',
                'satuan_kinerja' => 'satuan_hasil tidak boleh kosong!',
                'subkegiatan' => 'subkegiatan tidak boleh kosong!',
                'target_indikator' => 'target_indikator tidak boleh kosong!',
                'mulai' => 'mulai tidak boleh kosong!',
                'selesai' => 'selesai tidak boleh kosong!',
                'jenis' => 'jenis tidak boleh kosong!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'capaian' => 'capaian tidak boleh kosong!',
                'target_capaian' => 'target_capaian tidak boleh kosong!',
                'satuan_capaian' => 'satuan_capaian tidak boleh kosong!',
                'target_kinerja' => 'target_hasil tidak boleh kosong!',
                'satuan_kinerja' => 'satuan_hasil tidak boleh kosong!',
                'target_indikator' => 'target_indikator tidak boleh kosong!',
                'mulai' => 'mulai tidak boleh kosong!',
                'selesai' => 'selesai tidak boleh kosong!',
                'jenis' => 'jenis tidak boleh kosong!',
            ];
        }
        return [];
    }

    function storenomenrancangan()
    {
        $datasub = A5Subkegiatan::find($this->subkegiatan);
        $urusan = [
            'kode_opd' => $this->opd,
            'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
            'tahun' => tahun(),
        ];
        $create_urusan =  ['uraian' => $datasub->kegiatan->program->bidang->urusan->uraian,];

        $bidang = [
            'kode_opd' => $this->opd,
            'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
            'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
            'tahun' => tahun(),
        ];
        $create_bidang = ['uraian' => $datasub->kegiatan->program->bidang->uraian,];

        $program = [
            'kode_opd' => $this->opd,
            'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
            'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
            'kode_program' => $datasub->kegiatan->program->kode_program,
            'tahun' => tahun(),
        ];
        $create_program = ['uraian' => $datasub->kegiatan->program->uraian,];

        $kegiatan = [
            'kode_opd' => $this->opd,
            'kode_urusan' => $datasub->kegiatan->program->bidang->urusan->kode_urusan,
            'kode_bidang' => $datasub->kegiatan->program->bidang->kode_bidang,
            'kode_program' => $datasub->kegiatan->program->kode_program,
            'kode_kegiatan' => $datasub->kegiatan->kode_kegiatan,
            'tahun' => tahun(),
        ];
        $create_kegiatan = [
            'uraian' => $datasub->kegiatan->uraian,
            'capaian' => $this->capaian,
            'target_capaian' => str($this->target_capaian)->replace(',', '.'),
            'satuan_capaian' => $this->satuan_capaian,
        ];

        $subkegiatan = [
            'kode_opd' => $this->opd,
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
            'target_kinerja' => str($this->target_kinerja)->replace(',', '.'),
            'satuan_kinerja' => $this->satuan_kinerja,
            'indikator' => $datasub->indikator,
            'target_indikator' => str($this->target_indikator)->replace(',', '.'),
            'satuan' => $datasub->satuan,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
            'klasifikasi_belanja' => $datasub->klasifikasi_belanja,
            'jenis' => $this->jenis,
        ];

        Rancangan1Urusan::firstOrCreate($urusan, $create_urusan);
        Rancangan2Bidang::firstOrCreate($bidang, $create_bidang);
        Rancangan3Program::firstOrCreate($program, $create_program);
        Rancangan4Kegiatan::firstOrCreate($kegiatan, $create_kegiatan);
        return Rancangan5Subkegiatan::firstOrCreate($subkegiatan, $create_subkegiatan);
    }

    public function udpatenomenrancangan()
    {
        $subkegiatan = Rancangan5Subkegiatan::find($this->subkegiatan);
        $kegiatan = $subkegiatan->kegiatan;

        $kegiatan->capaian = $this->capaian;
        $kegiatan->target_capaian = str($this->target_capaian)->replace(',', '.');
        $kegiatan->satuan_capaian = $this->satuan_capaian;

        $subkegiatan->target_kinerja = str($this->target_kinerja)->replace(',', '.');
        $subkegiatan->satuan_kinerja = $this->satuan_kinerja;
        $subkegiatan->target_indikator = str($this->target_indikator)->replace(',', '.');
        $subkegiatan->mulai = $this->mulai;
        $subkegiatan->selesai = $this->selesai;
        $subkegiatan->jenis = $this->jenis;

        $kegiatan->save();
        $subkegiatan->save();
        return $subkegiatan;
    }

    public function destroynomenrancangan()
    {
        Rancangan5Subkegiatan::find($this->subkegiatan)->delete();
    }

    public function restorenomenrancangan()
    {
        Rancangan5Subkegiatan::onlyTrashed()->find($this->subkegiatan)->restore();
        return Rancangan5Subkegiatan::find($this->subkegiatan);
    }
}
