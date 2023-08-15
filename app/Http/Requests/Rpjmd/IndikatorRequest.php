<?php

namespace App\Http\Requests\Rpjmd;

use App\Models\RpjmdIndikator;
use Illuminate\Foundation\Http\FormRequest;

class IndikatorRequest extends FormRequest
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
                'periode' => 'required|numeric|exists:rpjmd_periodes,id',
                'visi' => 'required|numeric|exists:rpjmd_visis,id',
                'misi' => 'required|numeric|exists:rpjmd_misis,id',
                'tujuan' => 'required|numeric|exists:rpjmd_tujuans,id',
                'sasaran' => 'required|numeric|exists:rpjmd_sasarans,id',
                'indikator' => 'required',
                'satuan' => 'required',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'indikator' => 'required',
                'satuan' => 'required',
            ];
        }
        if ($this->aksi == 'destroy') {
            return [
                'id' => 'required',
            ];
        }
    }

    public function messages(): array
    {
        if ($this->aksi == 'create') {
            return [
                'periode.required' => '(required) Kesalahan input periode, silahkan hubungi admin untuk kesalahan ini!',
                'periode.numeric' => '(numeric) Kesalahan input periode, silahkan hubungi admin untuk kesalahan ini!',
                'periode.exists' => '(exists) Kesalahan input periode, silahkan hubungi admin untuk kesalahan ini!',

                'visi.required' => '(required) Kesalahan input visi, silahkan hubungi admin untuk kesalahan ini!',
                'visi.numeric' => '(numeric) Kesalahan input visi, silahkan hubungi admin untuk kesalahan ini!',
                'visi.exists' => '(exists) Kesalahan input visi, silahkan hubungi admin untuk kesalahan ini!',

                'misi.required' => '(required) Kesalahan input misi, silahkan hubungi admin untuk kesalahan ini!',
                'misi.numeric' => '(numeric) Kesalahan input misi, silahkan hubungi admin untuk kesalahan ini!',
                'misi.exists' => '(exists) Kesalahan input misi, silahkan hubungi admin untuk kesalahan ini!',

                'tujuan.required' => '(required) Kesalahan input tujuan, silahkan hubungi admin untuk kesalahan ini!',
                'tujuan.numeric' => '(numeric) Kesalahan input tujuan, silahkan hubungi admin untuk kesalahan ini!',
                'tujuan.exists' => '(exists) Kesalahan input tujuan, silahkan hubungi admin untuk kesalahan ini!',

                'sasaran.required' => '(required) Kesalahan input sasaran, silahkan hubungi admin untuk kesalahan ini!',
                'sasaran.numeric' => '(numeric) Kesalahan input sasaran, silahkan hubungi admin untuk kesalahan ini!',
                'sasaran.exists' => '(exists) Kesalahan input sasaran, silahkan hubungi admin untuk kesalahan ini!',

                'indikator.required' => 'Indikator tidak boleh kosong!',
                'satuan.required' => 'Satuan tidak boleh kosong!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'indikator.required' => 'Indikator tidak boleh kosong!',
                'satuan.required' => 'Satuan tidak boleh kosong!',
            ];
        }
        if ($this->aksi == 'destroy') {
            return [
                'id.required' => 'Indikator tidak boleh kosong!',
            ];
        }
    }

    public function store(): void
    {
        RpjmdIndikator::create([
            'rpjmd_periode_id' => $this->periode,
            'rpjmd_visi_id' => $this->visi,
            'rpjmd_misi_id' => $this->misi,
            'rpjmd_tujuan_id' => $this->tujuan,
            'rpjmd_sasaran_id' => $this->sasaran,
            'indikator' => $this->indikator,
            'satuan' => $this->satuan,
        ]);
    }

    public function update(): void
    {
        $data = RpjmdIndikator::find($this->indikatorid);
        $data->indikator = $this->indikator;
        $data->satuan = $this->satuan;
        $data->save();
    }

    public function destroy(): void
    {
        $data = RpjmdIndikator::find($this->id);
        $data->delete();
    }
}
