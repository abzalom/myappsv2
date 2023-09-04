<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggaran\Rancangan\Pendapatan7UraianRancangan;
use App\Models\Anggaran\Ranwal\Pendapatan6SubrincianRanwal;
use App\Models\Anggaran\Ranwal\Pendapatan7UraianRanwal;
use App\Models\B1AkunNeraca;
use App\Models\C6SubrincianLra;
use App\Models\OpdPagu;
use App\Models\PaguRanwalOpd;
use Illuminate\Http\Request;

class RekeningApiController extends Controller
{
    public function searchPendapatan(Request $request)
    {
        if ($request->q) {
            return C6SubrincianLra::search($request->q)->where('kode_unik_akun', '4')->get()->toJson();
        }
    }

    public function byidUraian(Request $request)
    {
        if ($request->tahapan == 'ranwal') {
            return Pendapatan7UraianRanwal::with('subrincian')->find($request->id);
        }
        if ($request->tahapan == 'rancangan') {
            return Pendapatan7UraianRancangan::with('subrincian')->find($request->id);
        }
    }

    public function searchUraian(Request $request)
    {
        // return $request->kode_opd;
        $pagu = PaguRanwalOpd::where('kode_opd', $request->kode_opd)->get('kode_uraian');
        // return $pagu;
        if (!$pagu) {
            return Pendapatan7UraianRanwal::get()->toJson();
        }
        $kode_uraian = [];
        foreach ($pagu as $value) {
            array_push($kode_uraian, $value->kode_uraian);
        }
        return Pendapatan7UraianRanwal::whereNotIn('kode_uraian', $kode_uraian)->get()->toJson();
    }
}
