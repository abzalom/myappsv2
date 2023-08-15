<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\A1Urusan;
use App\Models\A2Bidang;
use App\Models\A3Program;
use App\Models\A4Kegiatan;
use App\Models\A5Subkegiatan;
use Illuminate\Http\Request;

class NomensApiController extends Controller
{
    function urusan(Request $request)
    {
        if ($request->kode) {
            return A1Urusan::where('kode_urusan', $request->kode)->first();
        }
        return A1Urusan::get()->toJson();
    }

    function bidang(Request $request)
    {
        if ($request->kode) {
            return A2Bidang::with([
                'urusan'
            ])->where('kode_bidang', $request->kode)->first();
        }
        return A2Bidang::with([
            'urusan'
        ])->get()->toJson();
    }

    function program(Request $request)
    {
        if ($request->kode) {
            return A3Program::with([
                'bidang',
                'bidang.urusan',
            ])->where('kode_bidang', $request->kode)->first();
        }
        return A3Program::with([
            'bidang',
            'bidang.urusan',
        ])->get()->toJson();
    }

    function kegiatan(Request $request)
    {
        if ($request->kode) {
            return A4Kegiatan::with([
                'urusan',
                'urusan.bidang',
                'urusan.bidang.program',
            ])->where('kode_bidang', $request->kode)->first();
        }
        return A4Kegiatan::with([
            'urusan',
            'urusan.bidang',
            'urusan.bidang.program',
        ])->get()->toJson();
    }

    function subkegiatan(Request $request)
    {
        if ($request->kode) {
            return A5Subkegiatan::with([
                'urusan',
                'urusan.bidang',
                'urusan.bidang.program',
                'urusan.bidang.program.kegiatan',
            ])->where('kode_bidang', $request->kode)->first();
        }
        return A5Subkegiatan::with([
            'urusan',
            'urusan.bidang',
            'urusan.bidang.program',
            'urusan.bidang.program.kegiatan',
        ])->get()->toJson();
    }


    /**
     * Get API By Parent Kode
     */

    public function programbidang(Request $request)
    {
        if (!$request->rutin) {
            return A3Program::where('kode_bidang', $request->kode_bidang)->whereNot('kode_program', $request->kode_bidang . '.01')->get()->toJson();
        }
        return A3Program::where('kode_bidang', $request->kode_bidang)->get()->toJson();
    }

    public function kegiatanprogram(Request $request)
    {
        return A4Kegiatan::where('kode_program', $request->kode_program)->get()->toJson();
    }

    public function subkegiatankegiatan(Request $request)
    {
        return A5Subkegiatan::where('kode_kegiatan', $request->kode_kegiatan)->get()->toJson();
    }


    /**
     * API Subkegiatan by ID
     */

    public function subkegiatanid(Request $request)
    {
        return A5Subkegiatan::find($request->id);
    }
}
