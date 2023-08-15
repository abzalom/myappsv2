<?php

namespace App\Http\Requests\Rpjmd;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MisiRequest extends FormRequest
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
        return [
            'visi' => 'required',
            'nomor' => 'required|numeric',
            // 'nomor' => Rule::unique('rpjmd_misis', 'nomor')->where(fn (Builder $query) => $query->where('rpjmd_visi_id', $this->visi)),
            'misi' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'visi.required' => 'Visi harus pilih satu!',
            'nomor.required' => 'Nomor tidak boleh kosong!',
            'nomor.numeric' => 'Nomor urut hanya boleh angka!',
            'misi.required' => 'Misi tidak boleh kosong!',
        ];
    }
}
