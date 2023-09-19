<?php

namespace App\Http\Requests\Rkpd\Perubahan;

use App\Models\A5Subkegiatan;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Rkpd\Perubahan\Perubahan1Urusan;
use App\Models\Rkpd\Perubahan\Perubahan2Bidang;
use App\Models\Rkpd\Perubahan\Perubahan3Program;
use App\Models\Rkpd\Perubahan\Perubahan4Kegiatan;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;

class NomenPerubahanRenjaRequest extends FormRequest
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

    function storenomenperubahan()
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
            'menjadi_capaian' => $this->capaian,
            'menjadi_target_capaian' => str($this->target_capaian)->replace(',', '.'),
            'menjadi_satuan_capaian' => $this->satuan_capaian,
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
            'indikator' => $datasub->indikator,
            'satuan' => $datasub->satuan,
            'klasifikasi_belanja' => $datasub->klasifikasi_belanja,
            'menjadi_target_kinerja' => str($this->target_kinerja)->replace(',', '.'),
            'menjadi_satuan_kinerja' => $this->satuan_kinerja,
            'menjadi_target_indikator' => str($this->target_indikator)->replace(',', '.'),
            'menjadi_mulai' => $this->mulai,
            'menjadi_selesai' => $this->selesai,
            'menjadi_jenis' => $this->jenis,
        ];

        Perubahan1Urusan::firstOrCreate($urusan, $create_urusan);
        Perubahan2Bidang::firstOrCreate($bidang, $create_bidang);
        Perubahan3Program::firstOrCreate($program, $create_program);
        Perubahan4Kegiatan::firstOrCreate($kegiatan, $create_kegiatan);
        return Perubahan5Subkegiatan::firstOrCreate($subkegiatan, $create_subkegiatan);
    }

    public function udpatenomenperubahan()
    {
        $subkegiatan = Perubahan5Subkegiatan::find($this->subkegiatan);
        $kegiatan = $subkegiatan->kegiatan;

        $kegiatan->menjadi_capaian = $this->capaian;
        $kegiatan->menjadi_target_capaian = str($this->target_capaian)->replace(',', '.');
        $kegiatan->menjadi_satuan_capaian = $this->satuan_capaian;

        $subkegiatan->menjadi_target_kinerja = str($this->target_kinerja)->replace(',', '.');
        $subkegiatan->menjadi_satuan_kinerja = $this->satuan_kinerja;
        $subkegiatan->menjadi_target_indikator = str($this->target_indikator)->replace(',', '.');
        $subkegiatan->menjadi_mulai = $this->mulai;
        $subkegiatan->menjadi_selesai = $this->selesai;
        $subkegiatan->menjadi_jenis = $this->jenis;

        $kegiatan->save();
        $subkegiatan->save();
        return $subkegiatan;
    }

    public function destroynomenperubahan()
    {
        Perubahan5Subkegiatan::find($this->subkegiatan)->delete();
    }

    public function restorenomenperubahan()
    {
        Perubahan5Subkegiatan::onlyTrashed()->find($this->subkegiatan)->restore();
        return Perubahan5Subkegiatan::find($this->subkegiatan);
    }
}
