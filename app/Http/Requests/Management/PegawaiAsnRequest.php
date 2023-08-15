<?php

namespace App\Http\Requests\Management;

use App\Models\Opd;
use App\Models\OpdPegawai;
use App\Models\Pegawai\Pegawai;
use App\Models\Referensi\Jabatan;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiAsnRequest extends FormRequest
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
                'nama' => 'required',
                'nip' => 'required|numeric|digits_between:18,21|unique:pegawais,nip',
                'pangkat' => 'required',
                'phone' => 'required|numeric|unique:pegawais,phone',
                'email' => 'required|email|unique:pegawais,email',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'nama' => 'required',
                'pangkat' => 'required',
                'phone' => 'required|numeric|unique:pegawais,phone,' . $this->id,
                'email' => 'required|email|unique:pegawais,email,' . $this->id,
            ];
        }
        return [
            //
        ];
    }

    public function messages()
    {
        if ($this->aksi == 'create') {
            return [
                'nama.required' => 'Nama tidak boleh kosong!',
                'nip.required' => 'Nip tidak boleh kosong!',
                'nip.digits_between' => 'Nip minimal 18 digit dan maksimal 21 digit!',
                'nip.numeric' => 'Nip harus berupa angka!',
                'nip.unique' => 'Nip sudah terdaftar!',
                'pangkat.required' => 'Pangkat tidak boleh kosong!',
                'phone.required' => 'Nomor HP tidak boleh kosong!',
                'phone.numeric' => 'Nomor HP harus berupa anggka!',
                'phone.unique' => 'Nomor HP sudah terdaftar!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Foramt email salah!',
                'email.unique' => 'Email sudah terdaftar!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'nama.required' => 'Nama tidak boleh kosong!',
                'pangkat.required' => 'Pangkat tidak boleh kosong!',
                'phone.required' => 'Nomor HP tidak boleh kosong!',
                'phone.numeric' => 'Nomor HP harus berupa anggka!',
                'phone.unique' => 'Nomor HP sudah terdaftar!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Foramt email salah!',
                'email.unique' => 'Email sudah terdaftar!',
            ];
        }
        return [
            //
        ];
    }

    public function storeasn()
    {
        return Pegawai::firstOrCreate(
            [
                'nip' => $this->nip,
                'phone' => $this->phone,
                'email' => $this->email,
            ],
            [
                'nama' => $this->nama,
                'pangkat_pegawai_id' => $this->pangkat,
            ]
        );
    }

    function createuserasn()
    {
        $pegawai = $this->storeasn();
        $user = User::create([
            'name' => $pegawai->nama,
            'username' => $pegawai->nip,
            'email' => $pegawai->email,
            'email_verified_at' => now(),
            'password' => Hash::make($pegawai->nip),
        ]);
        $user->assignRole('guest');
        return $pegawai;
    }

    public function updateasn()
    {
        $pegawai = Pegawai::find($this->id);
        if ($pegawai->nama !== $this->nama) {
            $pegawai->nama = $this->nama;
        }
        if ($pegawai->pangkat_pegawai_id !== $this->pangkat) {
            $pegawai->pangkat_pegawai_id = $this->pangkat;
        }
        if ($pegawai->phone !== $this->phone) {
            $pegawai->phone = $this->phone;
        }
        if ($pegawai->email !== $this->email) {
            $pegawai->email = $this->email;
        }
        $pegawai->save();
        return $pegawai;
    }

    public function updateopdjababtan()
    {
        $pegawai = $this->updateasn();
        $opdpegawai = new OpdPegawai;
        $opdpegawai->where(
            ['nip' => $pegawai->nip],
        )->delete();
        $opd = Opd::find($this->opd);
        $jabatan = Jabatan::find($this->jabatan);
        $opdpegawai = $opdpegawai->create([
            'nip' => $pegawai->nip,
            'kode_opd' => $opd->kode_opd,
            'jabatan' => $jabatan->nama,
            'tahun' => tahun(),
        ]);
        $pegawai->user->syncRoles($jabatan->role);
    }
}
