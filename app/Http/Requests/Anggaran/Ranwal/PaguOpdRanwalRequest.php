<?php

namespace App\Http\Requests\Anggaran\Ranwal;

use App\Models\PaguRanwalOpd;
use App\Models\SumberdanaRanwal;
use Illuminate\Foundation\Http\FormRequest;

class PaguOpdRanwalRequest extends FormRequest
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
            $sumberdana = SumberdanaRanwal::with('pagus')->withSum('pagus', 'jumlah')->find($this->uraian);
            return $sumberdana;
            $sisah = [
                'uraian' => $sumberdana->uraian,
                'jumlah' => $sumberdana->jumlah - $sumberdana->pagus_sum_jumlah,
            ];
            return $sisah;
        }
        if ($this->aksi == 'update') {
            $pagu = PaguRanwalOpd::find($this->idpagu);
            $sumberdana = SumberdanaRanwal::withSum([
                'pagus' => fn ($q) => $q->whereNot('id', $pagu->id)
            ], 'jumlah')->find($this->idsumberdana);
            $sisah = [
                'uraian' => $sumberdana->uraian,
                'jumlah' => $sumberdana->jumlah - $sumberdana->pagus_sum_jumlah,
            ];
            return $sisah;
        }
    }

    public function storepagu()
    {
        $sumberdana = SumberdanaRanwal::find($this->uraian);
        $count = PaguRanwalOpd::withTrashed()->where('kode_unik_sumberdana', $sumberdana->kode_unik)->count();
        PaguRanwalOpd::create([
            'kode_opd' => $this->opd,
            // 'sumberdana_ranwal_id' => $sumberdana->id,
            'kode_sumberdana' => $sumberdana->kode_sumberdana,
            'kode_unik_sumberdana' => $sumberdana->kode_unik,
            'jumlah' => $this->jumlah,
            'tahun' => tahun(),
        ]);
    }

    public function updatepagu()
    {
        $pagu = PaguRanwalOpd::find($this->idpagu);
        $pagu->jumlah = $this->jumlah;
        $pagu->save();
    }

    public function destorypagu()
    {
        PaguRanwalOpd::find($this->idpagu)->delete();
    }

    public function restorepagu()
    {
        return PaguRanwalOpd::onlyTrashed()->find($this->idpagu)->restore();
    }
}
