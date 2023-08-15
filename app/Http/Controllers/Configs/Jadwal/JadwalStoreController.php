<?php

namespace App\Http\Controllers\Configs\Jadwal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rkpd\JadwalRkpdRequest;
use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class JadwalStoreController extends Controller
{
    public function store_jadwal_rkpd(Request $request)
    {
        $request->validate(
            [
                'tahapan' => [
                    'bail',
                    'required',
                    Rule::unique('jadwal_rkpds', 'tahapan')->where('tahun', session()->get('tahun'))->whereNull('deleted_at')
                ],
                'mulai' => 'required|date',
                'selesai' => 'required|date',
            ],
            [
                'tahapan.required' => 'Tahapan tidak boleh kosong!',
                'tahapan.unique' => 'Tahapan pelaksanaan sudah ada. Kunci dulu tahapan sebelumnya!',
                'mulai.required' => 'Waktu mulai pelaksanaan tidak boleh kosong!',
                'mulai.date' => 'Format waktu mulai pelaksanaan salah!',
                'selesai.required' => 'Waktu selesai pelaksanaan tidak boleh kosong!',
                'selesai.date' => 'Format waktu selesai pelaksanaan salah!',
            ]
        );
        $check = DB::table('jadwal_rkpds')->where([
            'tahun' => session()->get('tahun'),
            'deleted_at' => null,
        ])->first();
        if ($check) {
            return redirect()->to('/config/jadwal')->with('pesan', 'Tahapan sebelumnya masih aktif. Silahkan kunci tahapan sebelumnya terlebih dahulu');
        }
        $jadwal = DB::table('jadwal_rkpds')->insert([
            'tahapan' => $request->tahapan,
            'keterangan' => $request->keterangan,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'tahun' => session()->get('tahun'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->to('/config/jadwal')->with('pesan', 'Jadwal pelaksanaan RKPD tahapan ' . $request->tahapan . ' telah dibuat');
    }

    public function update_jadwal_rkpd(Request $request)
    {
        $jadwal = DB::table('jadwal_rkpds')->where(['id' => $request->id])->update([
            'keterangan' => $request->keterangan,
            // 'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'updated_at' => now(),
        ]);
        return redirect()->to('/config/jadwal')->with('pesan', 'Jadwal pelaksanaan RKPD tahapan ' . $request->tahapan . ' telah diupdate');
    }

    public function destory_jadwal_rkpd(Request $request)
    {
        $jadwal = DB::table('jadwal_rkpds')->where('id', $request->id)->update([
            'deleted_at' => now()
        ]);
        return redirect()->to('/config/jadwal')->with('pesan', 'Jadwal pelaksanaan RKPD tahapan dikunci!');
    }

    public function synchorn(Request $request)
    {
        if ($request->tahapan == 'rancangan') {
            return Ranwal1Urusan::with([
                'bidangs',
                'bidangs.programs',
                'bidangs.programs.kegiatans',
                'bidangs.programs.kegiatans.subkegiatans',
                'bidangs.programs.kegiatans.subkegiatans.subkeluarans',
            ])->get();
        }
    }
}
