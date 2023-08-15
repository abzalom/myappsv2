<?php

namespace App\Http\Requests\Rpjmd;

use App\Models\A3Program;
use App\Models\RpjmdProgram;
use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
                'indikator' => 'required|numeric|exists:rpjmd_sasarans,id',
                'program' => 'required',
                'program.*' => 'exists:a3_programs,kode_program',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'program' => 'required',
                'program.*' => 'exists:a3_programs,kode_program',
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

                'indikator.required' => '(required) Kesalahan input indikator, silahkan hubungi admin untuk kesalahan ini!',
                'indikator.numeric' => '(numeric) Kesalahan input indikator, silahkan hubungi admin untuk kesalahan ini!',
                'indikator.exists' => '(exists) Kesalahan input indikator, silahkan hubungi admin untuk kesalahan ini!',

                'program.required' => 'Program tidak boleh kosong!',
                'program.*.exists' => '(exists) Kesalahan input Program, silahkan hubungi admin untuk kesalahan ini!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'program.required' => 'Program tidak boleh kosong!',
                'program.exists' => '(exists) Kesalahan input Program, silahkan hubungi admin untuk kesalahan ini!',
            ];
        }
        if ($this->aksi == 'destroy') {
            return [
                'id.required' => 'Tidak dapat menghapus program, terdapat kesalahan, silahkan hubungi admin untuk kesalahan ini!',
            ];
        }
    }

    public function store()
    {
        foreach ($this->program as $value) {
            $data = $program = A3Program::where('kode_program', $value)->first();
            RpjmdProgram::create([
                'rpjmd_periode_id' => $this->periode,
                'rpjmd_visi_id' => $this->visi,
                'rpjmd_misi_id' => $this->misi,
                'rpjmd_tujuan_id' => $this->tujuan,
                'rpjmd_sasaran_id' => $this->sasaran,
                'rpjmd_indikator_id' => $this->indikator,
                'kode_urusan' => $program->kode_urusan,
                'kode_bidang' => $program->kode_bidang,
                'kode_program' => $program->kode_program,
            ]);
        }
    }

    public function destroy(): void
    {
        $data = RpjmdProgram::find($this->id);
        $data->delete();
    }
}
