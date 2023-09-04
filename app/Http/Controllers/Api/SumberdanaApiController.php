<?php

namespace App\Http\Controllers\Api;

use App\Models\SumberDana;
use Illuminate\Http\Request;
use App\Models\PaguRanwalOpd;
use App\Http\Controllers\Controller;
use App\Models\PaguRancanganOpd;
use App\Models\SumberdanaRancangan;
use App\Models\SumberdanaRanwal;

class SumberdanaApiController extends Controller
{
    public function searchSumberdanaRanwal(Request $request)
    {
        $pagu = PaguRanwalOpd::where('kode_opd', $request->kode_opd)->get('kode_sumberdana');
        // return $pagu;
        if (!$pagu) {
            return SumberdanaRanwal::get()->toJson();
        }
        $kode_sumberdana = [];
        foreach ($pagu as $value) {
            array_push($kode_sumberdana, $value->kode_sumberdana);
        }
        return SumberdanaRanwal::whereNotIn('kode_sumberdana', $kode_sumberdana)->get()->toJson();
    }

    public function idSumberdanaRanwal(Request $request)
    {
        return PaguRanwalOpd::with('sumberdana')->find($request->id);
    }

    public function searchSumberdanRancangan(Request $request)
    {
        $pagu = PaguRancanganOpd::where('kode_opd', $request->kode_opd)->get('kode_sumberdana');
        // return $pagu;
        if (!$pagu) {
            return SumberdanaRancangan::get()->toJson();
        }
        $kode_sumberdana = [];
        foreach ($pagu as $value) {
            array_push($kode_sumberdana, $value->kode_sumberdana);
        }
        return SumberdanaRancangan::whereNotIn('kode_sumberdana', $kode_sumberdana)->get()->toJson();
    }

    public function idSumberdanaRancangan(Request $request)
    {
        return PaguRancanganOpd::with('sumberdana')->find($request->id);
    }
}
