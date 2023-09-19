<?php

namespace App\Http\Requests\Management;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
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
        $this->merge(
            [
                'username' => str($this->username)->replace(' ', '-')
            ]
        );
        if ($this->aksi == 'create') {
            return [
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|unique:users,email',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'name' => 'required',
                'username' => 'required|unique:users,username,' . decrypt($this->id),
                'email' => 'required|unique:users,email,' . decrypt($this->id),
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
                'name.required' => 'Nama tidak boleh kosong!',
                'username.required' => 'Username tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'name.unique' => $this->name . ' sudah digunakan!',
                'username.unique' => $this->username . ' sudah digunakan!',
                'email.unique' => $this->email . ' sudah digunakan!',
            ];
        }
        if ($this->aksi == 'update') {
            return [
                'name.required' => 'Nama tidak boleh kosong!',
                'username.required' => 'Username tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'name.unique' => $this->name . ' sudah digunakan!',
                'username.unique' => $this->username . ' sudah digunakan!',
                'email.unique' => $this->email . ' sudah digunakan!',
            ];
        }
        return [
            //
        ];
    }

    public function storeuser()
    {
        $user = User::create([
            'name' => $this->name,
            'username' => str($this->username)->replace(' ', '-'),
            'email' => $this->email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($this->roles);
        return $user;
    }

    public function updateuser()
    {
        $id = decrypt($this->id);
        $user = User::find($id);
        $user->name = $this->name;
        $user->username = str($this->username)->replace(' ', '-');
        $user->email = $this->email;
        $user->save();
        $user->syncRoles($this->roles);
        return $user;
    }

    public function resetuser()
    {
        $id = decrypt($this->id);
        $user = User::find($id);
        $user->password = Hash::make('password');
        $user->save();
        return $user;
    }

    public function lockuser()
    {
        $id = decrypt($this->id);
        $user = User::find($id);
        $username = $user->username;
        $user->delete();
        return $username;
    }

    public function unlockuser()
    {
        $id = decrypt($this->id);
        $user = User::withTrashed()->find($id);
        $roles = [
            'eselon-2a',
            'eselon-2b',
            'eselon-3a',
            'eselon-3b',
            'eselon-4a',
            'eselon-4b',
            'eselon-5a',
            'staf',
        ];
        if ($user->hasRole($roles)) {
            $user = User::with('pegawai')
                ->withTrashed()
                ->find($id);
            if (!$user->pegawai) {
                return [
                    'pegawai' => false,
                    'username' => $user->username,
                ];
            }
        }
        $user->restore();
        return [
            'pegawai' => true,
            'username' => $user->username,
        ];;
    }
}
