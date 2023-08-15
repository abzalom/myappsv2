<?php

namespace App\Http\Requests\Anggaran;

use App\Models\Anggaran\Ranwal\Pendapatan1AkunRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan2KelompokRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan3JenisRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan4ObjekRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan5RincianRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan6SubrincianRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;
use App\Models\C6SubrincianLra;
use App\Models\PaguRanwalOpd;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

class PendapatanRequest extends FormRequest
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
        if ($this->aksi == 'update') {
            return [
                'uraian' => 'required',
                'jumlah' => 'required',
            ];
        }
        if ($this->aksi == 'create') {
            return [
                'rekening' => 'required',
                'uraian' => 'required',
                'jumlah' => 'required',
            ];
        }
        return [];
    }

    public function messages(): array
    {
        if ($this->aksi == 'update') {
            return [
                'uraian.required' => 'Uraian pendapatan tidak boleh kosong!',
                'jumlah.required' => 'Jumlah pendapatan tidak boleh kosong!',
            ];
        }
        if ($this->aksi == 'create') {
            return [
                'rekening.required' => 'Rekening pendapatan tidak boleh kosong!',
                'uraian.required' => 'Uraian pendapatan tidak boleh kosong!',
                'jumlah.required' => 'Jumlah pendapatan tidak boleh kosong!',
            ];
        }
        return [];
    }

    public function storerekening()
    {
        $subrincian = C6SubrincianLra::where('kode_unik_subrincian', $this->rekening)->first();
        $rincian = $subrincian->rincian;
        $objek = $subrincian->rincian->objek;
        $jenis = $subrincian->rincian->objek->jenis;
        $kelompok = $subrincian->rincian->objek->jenis->kelompok;
        $akun = $subrincian->rincian->objek->jenis->kelompok->akun;
        Pendapatan1AkunRanwal::firstOrCreate([
            'kode_akun' => $akun->kode_unik_akun,
            'uraian' => $akun->uraian,
            'tahun' => tahun(),
        ]);
        Pendapatan2KelompokRanwal::firstOrCreate([
            'kode_akun' => $kelompok->kode_unik_akun,
            'kode_kelompok' => $kelompok->kode_unik_kelompok,
            'uraian' => $kelompok->uraian,
            'tahun' => tahun(),
        ]);
        Pendapatan3JenisRanwal::firstOrCreate([
            'kode_akun' => $jenis->kode_unik_akun,
            'kode_kelompok' => $jenis->kode_unik_kelompok,
            'kode_jenis' => $jenis->kode_unik_jenis,
            'uraian' => $jenis->uraian,
            'tahun' => tahun(),
        ]);
        Pendapatan4ObjekRanwal::firstOrCreate([
            'kode_akun' => $objek->kode_unik_akun,
            'kode_kelompok' => $objek->kode_unik_kelompok,
            'kode_jenis' => $objek->kode_unik_jenis,
            'kode_objek' => $objek->kode_unik_objek,
            'uraian' => $objek->uraian,
            'tahun' => tahun(),
        ]);
        Pendapatan5RincianRanwal::firstOrCreate([
            'kode_akun' => $rincian->kode_unik_akun,
            'kode_kelompok' => $rincian->kode_unik_kelompok,
            'kode_jenis' => $rincian->kode_unik_jenis,
            'kode_objek' => $rincian->kode_unik_objek,
            'kode_rincian' => $rincian->kode_unik_rincian,
            'uraian' => $rincian->uraian,
            'tahun' => tahun(),
        ]);
        return Pendapatan6SubrincianRanwal::firstOrCreate([
            'kode_akun' => $subrincian->kode_unik_akun,
            'kode_kelompok' => $subrincian->kode_unik_kelompok,
            'kode_jenis' => $subrincian->kode_unik_jenis,
            'kode_objek' => $subrincian->kode_unik_objek,
            'kode_rincian' => $subrincian->kode_unik_rincian,
            'kode_subrincian' => $subrincian->kode_unik_subrincian,
            'uraian' => $subrincian->uraian,
            'tahun' => tahun(),
        ]);
    }

    public function storeuraian($subrincian)
    {
        $data = Pendapatan7UraianRanwal::where([
            'kode_subrincian' => $subrincian->kode_subrincian,
            'tahun' => tahun(),
        ])->orderBy('kode_uraian', 'desc');
        if ($data->get()->count() == 0) {
            return Pendapatan7UraianRanwal::create([
                'kode_akun' => $subrincian->kode_akun,
                'kode_kelompok' => $subrincian->kode_kelompok,
                'kode_jenis' => $subrincian->kode_jenis,
                'kode_objek' => $subrincian->kode_objek,
                'kode_rincian' => $subrincian->kode_rincian,
                'kode_subrincian' => $subrincian->kode_subrincian,
                'kode_uraian' => $subrincian->kode_subrincian . '.' . $data->get()->count() + 1,
                'uraian' => $this->uraian,
                'jumlah' => str_replace(',', '.', $this->jumlah),
                'tahun' => tahun(),
            ]);
        }
        $uraian = $data->first();
        $nomor = substr($uraian->kode_uraian, -1) + 1;
        return Pendapatan7UraianRanwal::create([
            'kode_akun' => $subrincian->kode_akun,
            'kode_kelompok' => $subrincian->kode_kelompok,
            'kode_jenis' => $subrincian->kode_jenis,
            'kode_objek' => $subrincian->kode_objek,
            'kode_rincian' => $subrincian->kode_rincian,
            'kode_subrincian' => $subrincian->kode_subrincian,
            'kode_uraian' => $subrincian->kode_subrincian . '.' . $nomor,
            'uraian' => $this->uraian,
            'jumlah' => str_replace(',', '.', $this->jumlah),
            'tahun' => tahun(),
        ]);
    }

    public function updateuraian()
    {
        $uraian = Pendapatan7UraianRanwal::find($this->iduraian);
        $jumlah = str_replace(',', '.', $this->jumlah);
        // return $jumlah;
        // return gettype((float)$jumlah);
        $uraian->uraian = $this->uraian;
        $uraian->jumlah = (float) $jumlah;
        $uraian->save();
        return $uraian;
    }

    public function destroyuraian()
    {
        $uraian = Pendapatan7UraianRanwal::find($this->id);
        PaguRanwalOpd::where('kode_uraian', $uraian->kode_uraian)->delete();
        $uraian->delete();
    }

    public function restoreuraian()
    {
        $uraian = Pendapatan7UraianRanwal::onlyTrashed()->find($this->id);
        PaguRanwalOpd::onlyTrashed()->where('kode_uraian', $uraian->kode_uraian)->restore();
        $uraian->restore();
        return $uraian;
    }
}
