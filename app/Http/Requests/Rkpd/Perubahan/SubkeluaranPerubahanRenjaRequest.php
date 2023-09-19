<?php

namespace App\Http\Requests\Rkpd\Perubahan;

use App\Models\Opd;
use App\Models\PaguOpd\PaguPerubahanOpd;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use App\Models\Rkpd\Perubahan\Perubahan6Subkeluaran;

class SubkeluaranPerubahanRenjaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->aksi == 'create') {
            return [
                'uraian' => 'required',
                'target' => 'required',
                'anggaran' => 'required',
                'sumberdana' => 'required',
                'lokasi' => 'required',
                'anggaran_maju' => 'required',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'uraian' => 'required',
                'target' => 'required',
                'anggaran' => 'required',
                'sumberdana' => 'required',
                'lokasi' => 'required',
                'anggaran_maju' => 'required',
            ];
        }
        return [];
    }

    public function messages()
    {
        if ($this->aksi == 'create') {
            return [
                'uraian.required' => 'uraian tidak boleh kosong!',
                'target.required' => 'target tidak boleh kosong!',
                'anggaran.required' => 'anggaran tidak boleh kosong!',
                'sumberdana.required' => 'sumberdana tidak boleh kosong!',
                'lokasi.required' => 'lokasi tidak boleh kosong!',
                'anggaran_maju.required' => 'anggaran_maju tidak boleh kosong!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'uraian.required' => 'uraian tidak boleh kosong!',
                'target.required' => 'target tidak boleh kosong!',
                'anggaran.required' => 'anggaran tidak boleh kosong!',
                'sumberdana.required' => 'sumberdana tidak boleh kosong!',
                'lokasi.required' => 'lokasi tidak boleh kosong!',
                'anggaran_maju.required' => 'anggaran_maju tidak boleh kosong!',
            ];
        }
        return [];
    }

    public function checkpagu()
    {
        $opd = Opd::find($this->opd);
        $pagu = PaguPerubahanOpd::withSum(
            [
                'menjadi_subkeluarans as sisa_sumberdana' => fn ($q) => $q
                    ->where('kode_opd', $opd->kode_opd)
            ],
            'menjadi_anggaran'
        )->find($this->sumberdana);
        $sisa = $pagu->menjadi_jumlah - $pagu->sisa_sumberdana;
        $sisa = $sisa - $this->anggaran;
        if ($sisa < 0) {
            return false;
        }
        return true;
    }

    public function checkpaguupdate()
    {
        $opd = Opd::find($this->opd);
        $subkel = Perubahan6Subkeluaran::find($this->subkeluaran);
        $paguopd = PaguPerubahanOpd::where(
            ['kode_opd' => $opd->kode_opd],
        )->withSum(
            [
                'menjadi_subkeluarans as sisa_sumberdana' => fn ($q) => $q
                    ->where('kode_opd', $opd->kode_opd)
                    ->whereNot('kode_subkeluaran', $subkel->kode_subkeluaran)
            ],
            'menjadi_anggaran'
        )->find($this->sumberdana);
        $sisa_sumberdana = $paguopd->menjadi_jumlah - $paguopd->sisa_sumberdana;
        $sisa_setelah_input = $sisa_sumberdana - $this->anggaran;
        if ($sisa_setelah_input < 0) {
            return [
                'value' => false,
                'sumberdana' => $paguopd->sumberdana->uraian,
                'sisa' => $sisa_sumberdana,
                'input' => $this->anggaran,
            ];
        }
        return [
            'value' => true,
        ];
    }

    public function storesubkeluaran()
    {
        $subkeg = Perubahan5Subkegiatan::find($this->subkegiatan);
        $countsubkel = Perubahan6Subkeluaran::where([
            'kode_opd' => $subkeg->kode_opd,
            'kode_subkegiatan' => $subkeg->kode_subkegiatan,
            'tahun' => $subkeg->tahun,
        ])->orderBy('kode_subkeluaran', 'desc');
        $sumberdana = PaguPerubahanOpd::find($this->sumberdana);
        if ($countsubkel->get()->count() == 0) {
            $data = [
                'kode_opd' => $subkeg->kode_opd,
                'kode_urusan' => $subkeg->kode_urusan,
                'kode_bidang' => $subkeg->kode_bidang,
                'kode_program' => $subkeg->kode_program,
                'kode_kegiatan' => $subkeg->kode_kegiatan,
                'kode_subkegiatan' => $subkeg->kode_subkegiatan,
                'kode_subkeluaran' => $subkeg->kode_subkegiatan . '.1',
                'uraian' => $this->uraian,
                'menjadi_target' => $this->target,
                'menjadi_satuan' => $subkeg->satuan,
                'menjadi_anggaran' => $this->anggaran,
                'menjadi_anggaran_maju' => $this->anggaran_maju,
                'menjadi_sumberdana' => $sumberdana->kode_unik_sumberdana,
                'menjadi_lokasi' => $this->lokasi,
                'tahun' => tahun(),
            ];
            return Perubahan6Subkeluaran::create($data);
        }
        $nomor = substr($countsubkel->first()->kode_subkeluaran, -1) + 1;
        $data = [
            'kode_opd' => $subkeg->kode_opd,
            'kode_urusan' => $subkeg->kode_urusan,
            'kode_bidang' => $subkeg->kode_bidang,
            'kode_program' => $subkeg->kode_program,
            'kode_kegiatan' => $subkeg->kode_kegiatan,
            'kode_subkegiatan' => $subkeg->kode_subkegiatan,
            'kode_subkeluaran' => $subkeg->kode_subkegiatan . '.' . $nomor,
            'uraian' => $this->uraian,
            'menjadi_target' => $this->target,
            'menjadi_satuan' => $subkeg->satuan,
            'menjadi_anggaran' => $this->anggaran,
            'menjadi_anggaran_maju' => $this->anggaran_maju,
            'menjadi_sumberdana' => $sumberdana->kode_unik_sumberdana,
            'menjadi_lokasi' => $this->lokasi,
            'tahun' => tahun(),
        ];
        return Perubahan6Subkeluaran::create($data);
    }

    public function updatesubkeluaran()
    {
        $sumberdana = PaguPerubahanOpd::find($this->sumberdana);
        $subkeluaran = Perubahan6Subkeluaran::find($this->subkeluaran);

        $subkeluaran->uraian = $this->uraian;
        $subkeluaran->menjadi_target = $this->target;
        $subkeluaran->menjadi_anggaran = $this->anggaran;
        $subkeluaran->menjadi_anggaran_maju = $this->anggaran_maju;
        $subkeluaran->menjadi_sumberdana = $sumberdana->kode_unik_sumberdana;
        $subkeluaran->menjadi_lokasi = $this->lokasi;
        $subkeluaran->save();
        return $subkeluaran;
    }

    public function destroysubkeluaran()
    {
        $subkeluaran = Perubahan6Subkeluaran::find($this->subkeluaran);
        $subkeluaran->delete();
    }

    public function restoresubkeluaran()
    {
        Perubahan6Subkeluaran::onlyTrashed()->find($this->subkeluaran)->restore();
        return Perubahan6Subkeluaran::find($this->subkeluaran);
    }
}
