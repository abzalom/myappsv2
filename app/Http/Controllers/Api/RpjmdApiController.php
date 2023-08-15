<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\A3Program;
use App\Models\RpjmdIndikator;
use App\Models\RpjmdMisi;
use App\Models\RpjmdPeriode;
use App\Models\RpjmdProgram;
use App\Models\RpjmdSasaran;
use App\Models\RpjmdTujuan;
use App\Models\RpjmdVisi;
use Illuminate\Http\Request;

class RpjmdApiController extends Controller
{
    function periode(Request $request)
    {
        if ($request->id) {
            return RpjmdPeriode::with(
                [
                    'visis',
                    'visis.misis',
                    'visis.misis.tujuans',
                    'visis.misis.tujuans.sasarans',
                    'visis.misis.tujuans.sasarans.indikators',
                    'visis.misis.tujuans.sasarans.indikators.programs',
                ]
            )->find($request->id);
        }
        return RpjmdPeriode::gett()->toJson();
    }

    function visi(Request $request)
    {
        if ($request->id) {
            return RpjmdVisi::with(
                [
                    'periode',
                ]
            )->where('rpjmd_visi_id', $request->id)->get()->toJson();
        }
        return RpjmdVisi::gett()->toJson();
    }

    function misi(Request $request)
    {
        if ($request->visi) {
            return RpjmdMisi::with(
                [
                    'visi',
                    'visi.periode',
                ]
            )->where('rpjmd_visi_id', $request->visi)->get()->toJson();
        }
        return RpjmdMisi::gett()->toJson();
    }

    function tujuan(Request $request)
    {
        // return $request->all();
        if ($request->tujuan) {
            return RpjmdTujuan::with(
                [
                    'misi',
                    'misi.visi',
                    'misi.visi.periode',
                ]
            )->find($request->tujuan);
        }
        return RpjmdTujuan::get()->toJson();
    }

    function sasaran(Request $request)
    {
        // return $request->all();
        if ($request->id) {
            $data = RpjmdSasaran::with(
                [
                    'tujuan',
                    'tujuan.misi',
                    'tujuan.misi.visi',
                    'tujuan.misi.visi.periode',
                ]
            )->find($request->id);
            return $data;
        }
        return RpjmdSasaran::get()->toJson();
    }

    function indikator(Request $request)
    {

        if ($request->id) {
            $data['indikator'] = RpjmdIndikator::with(
                [
                    'programs',
                    'sasaran',
                    'sasaran.tujuan',
                    'sasaran.tujuan.misi',
                    'sasaran.tujuan.misi.visi',
                    'sasaran.tujuan.misi.visi.periode',
                ]
            )->find($request->id);
            $kode = [];
            foreach ($data['indikator']->programs as $value) {
                array_push($kode, $value->kode_program);
            }

            $data['programs'] = A3Program::whereNotIn('kode_program', $kode)->get();
            return $data;
        }
        return RpjmdIndikator::get()->toJson();
    }

    function program(Request $request)
    {
        // return $request->all();
        if ($request->id) {
            $data = RpjmdProgram::with(
                [
                    'nomen',
                    'indikator',
                    'indikator.sasaran',
                    'indikator.sasaran.tujuan',
                    'indikator.sasaran.tujuan.misi',
                    'indikator.sasaran.tujuan.misi.visi',
                    'indikator.sasaran.tujuan.misi.visi.periode',
                ]
            )
                ->whereHas('nomen')
                ->find($request->id);
            return $data;
        }
        if ($request->indikator) {
            $data = RpjmdProgram::with(
                [
                    'nomen',
                ]
            )
                ->where('rpjmd_indikator_id', $request->indikator)
                ->get();
            return $data;
        }
        return RpjmdProgram::with(
            [
                'nomen',
                'indikator',
                'indikator.sasaran',
                'indikator.sasaran.tujuan',
                'indikator.sasaran.tujuan.misi',
                'indikator.sasaran.tujuan.misi.visi',
                'indikator.sasaran.tujuan.misi.visi.periode',
            ]
        )
            ->whereHas('nomen')->get();
    }
}
