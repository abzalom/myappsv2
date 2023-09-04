<?php

namespace App\Http\Requests\Rkpd\Rancangan;

use App\Models\PaguRancanganOpd;
use App\Models\Rkpd\Rancangan\Rancangan5Subkegiatan;
use App\Models\Rkpd\Rancangan\Rancangan6Subkeluaran;
use Illuminate\Foundation\Http\FormRequest;

class SubkeluaranRancanganRenjaRequest extends FormRequest
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
        $pagu = PaguRancanganOpd::find($this->sumberdana);
        $sisa = $pagu->jumlah - $pagu->subkeluarans->sum('anggaran');
        $sisa = $sisa - $this->anggaran;
        if ($sisa < 0) {
            return false;
        }
        return true;
    }

    public function checkpaguupdate()
    {
        $subkel = Rancangan6Subkeluaran::find($this->subkeluaran);
        $pagu = PaguRancanganOpd::find($this->sumberdana);
        if ($subkel->sumberdana !== $pagu->kode_uraian) {
            $sisaalokasi = $pagu->jumlah - $pagu->subkeluarans->sum('anggaran');
            $sisa = $sisaalokasi - $this->anggaran;
            if ($sisa < 0) {
                return [
                    'value' => false,
                    'sumberdana' => $pagu->sumberdana->uraian,
                    'sisa' => $sisaalokasi,
                    'input' => $this->anggaran,
                ];
            }
            return [
                'value' => true,
            ];
        }
        $pagusubkel = $pagu->subkeluarans->sum('anggaran') - $subkel->anggaran;;
        $sisaalokasi = $pagu->jumlah - $pagusubkel;
        $sisa = $sisaalokasi - $this->anggaran;
        if ($sisa < 0) {
            return [
                'value' => false,
                'sumberdana' => $pagu->sumberdana->uraian,
                'sisa' => $sisaalokasi,
                'input' => $this->anggaran,
            ];
        }
        return [
            'value' => true,
        ];
    }

    public function storesubkeluaran()
    {
        $subkeg = Rancangan5Subkegiatan::find($this->subkegiatan);
        $countsubkel = Rancangan6Subkeluaran::where([
            'kode_opd' => $subkeg->kode_opd,
            'kode_subkegiatan' => $subkeg->kode_subkegiatan,
            'tahun' => $subkeg->tahun,
        ])->orderBy('kode_subkeluaran', 'desc');
        $sumberdana = PaguRancanganOpd::find($this->sumberdana);
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
                'target' => $this->target,
                'satuan' => $subkeg->satuan,
                'anggaran' => $this->anggaran,
                'anggaran_maju' => $this->anggaran_maju,
                'sumberdana' => $sumberdana->kode_unik_sumberdana,
                'lokasi' => $this->lokasi,
                'tahun' => tahun(),
            ];
            return Rancangan6Subkeluaran::create($data);
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
            'target' => $this->target,
            'satuan' => $subkeg->satuan,
            'anggaran' => $this->anggaran,
            'anggaran_maju' => $this->anggaran_maju,
            'sumberdana' => $sumberdana->kode_unik_sumberdana,
            'lokasi' => $this->lokasi,
            'tahun' => tahun(),
        ];
        return Rancangan6Subkeluaran::create($data);
    }

    public function updatesubkeluaran()
    {
        $sumberdana = PaguRancanganOpd::find($this->sumberdana);
        $subkeluaran = Rancangan6Subkeluaran::find($this->subkeluaran);

        $subkeluaran->uraian = $this->uraian;
        $subkeluaran->target = $this->target;
        $subkeluaran->anggaran = $this->anggaran;
        $subkeluaran->anggaran_maju = $this->anggaran_maju;
        $subkeluaran->sumberdana = $sumberdana->kode_unik_sumberdana;
        $subkeluaran->lokasi = $this->lokasi;
        $subkeluaran->tahun = tahun();
        $subkeluaran->save();
        return $subkeluaran;
    }

    public function destroysubkeluaran()
    {
        $subkeluaran = Rancangan6Subkeluaran::find($this->subkeluaran);
        $subkeluaran->delete();
    }

    public function restoresubkeluaran()
    {
        Rancangan6Subkeluaran::onlyTrashed()->find($this->subkeluaran)->restore();
        return Rancangan6Subkeluaran::find($this->subkeluaran);
    }
}
