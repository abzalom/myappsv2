<?php

namespace App\Http\Requests\Anggaran\Perubahan;

use App\Models\PaguOpd\PaguPerubahanOpd;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;

class PaguOpdPerubahanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->aksi == 'create') {
            return [
                'opd' => 'required|exists:opds,kode_opd',
                'uraian' => 'required|exists:sumberdana_ranwals,id',
                'jumlah' => 'required|numeric',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'jumlah' => 'required|numeric',
            ];
        }
        return [];
    }

    public function messages(): array
    {
        if ($this->aksi == 'create') {
            return [
                'opd.required' => 'Ada keselahan teknis, OPD belum dipilih. silahkan hubungi admin!',
                'uraian.required' => 'Sumber dana tidak boleh kosong!',
                'opd.exists' => '(EXISTS) Ada keselahan teknis pada data OPD. silahkan hubungi admin!',
                'uraian.exists' => '(EXISTS) Ada keselahan teknis pada data sumber dana. silahkan hubungi admin!',
                'jumlah.required' => 'Jumlah pagu tidak boleh kosong!',
                'jumlah.numeric' => 'Jumlah pagu hanya boleh anggka!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'jumlah.required' => 'Jumlah pagu tidak boleh kosong!',
                'jumlah.numeric' => 'Jumlah pagu hanya boleh anggka!',
            ];
        }
        return [];
    }

    public function sisahsumberdana()
    {
        if ($this->aksi == 'create') {
            $sumberdana = SumberdanaPerubahan::with('pagus')->withSum('pagus', 'menjadi_jumlah')->find($this->uraian);
            return $sumberdana;
            $sisah = [
                'uraian' => $sumberdana->uraian,
                'jumlah' => $sumberdana->jumlah - $sumberdana->pagus_sum_menjadi_jumlah,
            ];
            return $sisah;
        }
        if ($this->aksi == 'update') {
            $pagu = PaguPerubahanOpd::find($this->idpagu);
            $sumberdana = SumberdanaPerubahan::withSum([
                'pagus' => fn ($q) => $q->whereNot('id', $pagu->id)
            ], 'menjadi_jumlah')->find($this->idsumberdana);
            $sisah = [
                'uraian' => $sumberdana->uraian,
                'jumlah' => $sumberdana->jumlah - $sumberdana->pagus_sum_menjadi_jumlah,
            ];
            return $sisah;
        }
    }

    public function storepagu()
    {
        $sumberdana = SumberdanaPerubahan::find($this->uraian);
        $count = PaguPerubahanOpd::withTrashed()->where('kode_unik_sumberdana', $sumberdana->kode_unik)->count();
        PaguPerubahanOpd::create([
            'kode_opd' => $this->opd,
            // 'sumberdana_ranwal_id' => $sumberdana->id,
            'kode_sumberdana' => $sumberdana->kode_sumberdana,
            'kode_unik_sumberdana' => $sumberdana->kode_unik,
            'menjadi_jumlah' => $this->jumlah,
            'tahun' => tahun(),
        ]);
    }

    public function updatepagu()
    {
        $pagu = PaguPerubahanOpd::find($this->idpagu);
        $pagu->menjadi_jumlah = $this->jumlah;
        $pagu->save();
    }

    public function destorypagu()
    {
        PaguPerubahanOpd::find($this->idpagu)->delete();
    }

    public function restorepagu()
    {
        return PaguPerubahanOpd::onlyTrashed()->find($this->idpagu)->restore();
    }
}
