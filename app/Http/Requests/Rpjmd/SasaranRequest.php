<?php

namespace App\Http\Requests\Rpjmd;

use App\Models\RpjmdSasaran;
use Illuminate\Foundation\Http\FormRequest;

class SasaranRequest extends FormRequest
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
                'nomor' => 'required|numeric',
                'sasaran' => 'required',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'nomor' => 'required|numeric',
                'sasaran' => 'required',
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

                'nomor.required' => 'Nomor tidak boleh kosong!',
                'nomor.numeric' => 'Nomor tidak boleh kosong!',
                'sasaran.required' => 'Sasaran tidak boleh kosong!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'nomor.required' => 'Nomor tidak boleh kosong!',
                'sasaran.required' => 'Sasaran tidak boleh kosong!',
            ];
        }
    }

    public function store()
    {
        RpjmdSasaran::create([
            'rpjmd_periode_id' => $this->periode,
            'rpjmd_visi_id' => $this->visi,
            'rpjmd_misi_id' => $this->misi,
            'rpjmd_tujuan_id' => $this->tujuan,
            'nomor' => $this->nomor,
            'sasaran' => $this->sasaran,
        ]);
    }

    public function update()
    {
        $data = RpjmdSasaran::find($this->sasaranid);
        $data->nomor = $this->nomor;
        $data->sasaran = $this->sasaran;
        $data->save();
    }
}
