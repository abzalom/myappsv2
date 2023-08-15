<?php

namespace App\Http\Requests\Rpjmd;

use App\Models\RpjmdTujuan;
use Illuminate\Foundation\Http\FormRequest;

class TujuanRequest extends FormRequest
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
                'visi' => 'required',
                'misi' => 'required',
                'nomor' => 'required|numeric',
                'tujuan' => 'required',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'nomor' => 'required|numeric',
                'tujuan' => 'required',
            ];
        }
    }

    public function messages(): array
    {
        if ($this->aksi == 'create') {
            return [
                'visi.required' => 'Visi tidak boleh kosong!',
                'misi.required' => 'Misi tidak boleh kosong!',
                'nomor.required' => 'Nomor tidak boleh kosong!',
                'nomor.numeric' => 'Nomor hanya boleh angka!',
                'tujuan.required' => 'Tujuan tidak boleh kosong!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'nomor.required' => 'Nomor tidak boleh kosong!',
                'nomor.numeric' => 'Nomor hanya boleh angka!',
                'tujuan.required' => 'Tujuan tidak boleh kosong!',
            ];
        }
    }

    public function store()
    {
        $data = [
            'rpjmd_periode_id' => $this->periode_id,
            'rpjmd_visi_id' => $this->visi,
            'rpjmd_misi_id' => $this->misi,
            'nomor' => $this->nomor,
            'tujuan' => $this->tujuan,
        ];
        RpjmdTujuan::create($data);
    }

    public function update()
    {
        $tujuan = RpjmdTujuan::find($this->tujuanid);
        $tujuan->nomor = $this->nomor;
        $tujuan->tujuan = $this->tujuan;
        $tujuan->save();
    }
}
