<?php

namespace App\Http\Requests\Anggaran\Perubahan;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;

class SumberdanaPerubahanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->aksi == 'create') {
            return [
                'kode_sumberdana' => 'required|exists:sumber_danas,kode',
                'uraian' => 'required',
                'jumlah' => 'required|numeric',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'uraian' => 'required',
                'jumlah' => 'required|numeric',
            ];
        }

        return [
            //
        ];
    }

    public function messages(): array
    {
        if ($this->aksi == 'create') {
            return [
                'kode_sumberdana.required' => 'Akun sumber dana tidak boleh kosong!',
                'kode_sumberdana.exists' => 'Akun sumber dana' . $this->kode_sumberdana . ' tidak ditemukan, hubungi admin!',
                'uraian.required' => 'Uraian sumber pendanaan tidak boleh kosong!',
                'jumlah.required' => 'Jumlah anggaran tidak boleh kosong!',
                'jumlah.numeric' => 'Jumlah anggaran hanya boleh berupa angka!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'uraian.required' => 'Uraian sumber pendanaan tidak boleh kosong!',
                'jumlah.required' => 'Jumlah anggaran tidak boleh kosong!',
                'jumlah.numeric' => 'Jumlah anggaran hanya boleh berupa angka!',
            ];
        }
        return [
            //
        ];
    }

    public function storesumberdana()
    {
        $count = SumberdanaPerubahan::withTrashed()->where('kode_sumberdana', $this->kode_sumberdana)->count();
        return SumberdanaPerubahan::create([
            'kode_sumberdana' => $this->kode_sumberdana,
            'nomor' => $count + 1,
            'kode_unik' => $this->kode_sumberdana . '-' . $count + 1,
            'uraian' => $this->uraian,
            'jumlah' => $this->jumlah,
            'tahun' => session()->get('tahun'),
        ]);
    }

    public function updatesumbedana()
    {
        $sumberdana = SumberdanaPerubahan::find($this->id);
        $sumberdana->uraian = $this->uraian;
        $sumberdana->jumlah = $this->jumlah;
        $sumberdana->save();
        return $sumberdana;
    }

    public function destroysumberdana()
    {
        $sumberdana = SumberdanaPerubahan::find($this->id);
        $sumberdana->delete();
    }

    public function restoresumberdana()
    {
        $sumberdana = SumberdanaPerubahan::withTrashed()->find($this->id);
        $sumberdana->restore();
        return $sumberdana;
    }
}
