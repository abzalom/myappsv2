<?php

namespace App\Http\Requests\Management;

use App\Models\A2Bidang;
use App\Models\Opd;
use App\Models\OpdTag;
use Illuminate\Foundation\Http\FormRequest;

class OpdRequest extends FormRequest
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
        $data = [
            'opd' => 'required',
        ];
        if ($this->bidang1) {
            $data += [
                'bidang1' => 'exists:a2_bidangs,kode_bidang',
            ];
        }
        if ($this->bidang2) {
            $data += [
                'bidang2' => 'exists:a2_bidangs,kode_bidang',
            ];
        }
        if ($this->bidang3) {
            $data += [
                'bidang3' => 'exists:a2_bidangs,kode_bidang',
            ];
        }
        return $data;
    }

    public function messages(): array
    {
        return [
            'opd.required' => 'Nama perangkat daerah tidak boleh kosong!',
            'bidang1.exists' => 'Kesalahan tagging bidang 1, Hubungi admin!',
            'bidang2.exists' => 'Kesalahan tagging bidang 2, Hubungi admin!',
            'bidang3.exists' => 'Kesalahan tagging bidang 3, Hubungi admin!',
        ];
    }

    public function storeopd($kode_bidang, $nomor, $kode_opd)
    {
        return Opd::create([
            'kode_bidang' => $kode_bidang,
            'nomor' => $nomor,
            'kode_opd' => $kode_opd,
            'nama_opd' => $this->opd,
            'tahun' => tahun(),
        ]);
    }

    public function storetag($opd, $bidangs)
    {
        foreach ($bidangs as $bidang) {
            $getBidang = A2Bidang::where('kode_bidang', $bidang)->first();
            OpdTag::create([
                'kode_opd' => $opd->kode_opd,
                'kode_urusan' => $getBidang->kode_urusan,
                'kode_bidang' => $getBidang->kode_bidang,
                'tahun' => tahun(),
            ]);
        }
    }
}
