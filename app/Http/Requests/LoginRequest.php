<?php

namespace App\Http\Requests;

use App\Models\RpjmdPeriode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required',
        ];
    }

    function messages(): array
    {
        return [
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ];
    }

    public function authsession(): void
    {
        if (!Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => 'Username dan Password tidak cocok!'
            ]);
        }
    }

    public function setTahun()
    {
        $tahun = DB::table('tahuns')->where('active', true)->first();
        if (!$tahun) {
            return false;
        }
        session()->put('tahun', $tahun->tahun);
        return true;
    }

    public function periodeSession()
    {
        $periode = RpjmdPeriode::where('active', true)->first();
        // return $periode;
        if ($periode) {
            $interval = $periode->akhir - $periode->awal;
            $data['tahuns'] = [];
            $data['aktif'] = [];

            for ($i = 0; $i <= (int) $interval; $i++) {
                $tahun = $periode->awal + $i;
                array_push(
                    $data['tahuns'],
                    $tahun
                );
                if ($tahun == session()->get('tahun')) {
                    array_push(
                        $data['aktif'],
                        $tahun
                    );
                }
            }
            session()->put('periode', $data);
        }
    }
}
