<?php

namespace App\Http\Requests;

use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;
use App\Models\PaguRanwalOpd;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

class PaguOpdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->aksi == 'create') {
            return [
                'opd' => 'required|exists:opds,kode_opd',
                'uraian' => 'required|exists:pendapatan7_uraian_ranwals,kode_uraian',
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
            $pagu = PaguRanwalOpd::where('kode_uraian', $this->uraian)->get()->sum('jumlah');
            $uraian = Pendapatan7UraianRanwal::where('kode_uraian', $this->uraian)->first();
            $sisah = [
                'uraian' => $uraian->uraian,
                'jumlah' => (float)$uraian->jumlah - $pagu,
            ];
            return $sisah;
        }
        if ($this->aksi == 'update') {
            $pagu = PaguRanwalOpd::find($this->idpagu);
            // return $pagu->kode_uraian;
            $sumpagu = PaguRanwalOpd::where('kode_uraian', $pagu->kode_uraian)->get()->sum('jumlah');
            $sumpagu = $sumpagu - $pagu->jumlah;
            $uraian = Pendapatan7UraianRanwal::where('kode_uraian', $pagu->kode_uraian)->first();
            $sisah = [
                'uraian' => $uraian->uraian,
                'jumlah' => (float)$uraian->jumlah - $sumpagu,
            ];
            return $sisah;
        }
    }

    public function storepagu()
    {
        PaguRanwalOpd::create([
            'kode_opd' => $this->opd,
            'kode_uraian' => $this->uraian,
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
