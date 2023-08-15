<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use App\Models\A1Urusan;
use Illuminate\Http\Request;

class NomenklaturController extends Controller
{
    function urusan()
    {
        return view('referensi.nomenklatur.1-urusan', [
            'apps' => [
                'title' => 'Referensi',
                'desc' => 'REFERENSI NOMENKLATUR URUSAN',
            ],
            'nomens' => A1Urusan::get(),
        ]);
    }

    function bidang($urusan)
    {
        $nomen = A1Urusan::with([
            'bidangs'
        ])->where('kode_urusan', str($urusan)->replace('-', '.'))->first();
        // return $urusan;
        return view('referensi.nomenklatur.2-bidang', [
            'apps' => [
                'title' => 'Referensi',
                'desc' => 'REFERENSI NOMENKLATUR BIDANG',
            ],
            'nomen' => $nomen,
        ]);
    }

    function program($urusan, $bidang)
    {
        $nomen = A1Urusan::with([
            'bidang' => fn ($q) => $q->where('kode_bidang', str($bidang)->replace('-', '.'))
        ])->where('kode_urusan', str($urusan)->replace('-', '.'))->first();
        return view('referensi.nomenklatur.3-program', [
            'apps' => [
                'title' => 'Referensi',
                'desc' => 'REFERENSI NOMENKLATUR PROGRAM',
            ],
            'nomen' => $nomen,
        ]);
    }

    function kegiatan($urusan, $bidang, $program)
    {
        // return $program;
        $nomen = A1Urusan::with([
            'bidang' => fn ($q) => $q->where('kode_bidang', str($bidang)->replace('-', '.')),
            'bidang.program' => fn ($q) => $q->where('kode_program', str($program)->replace('-', '.')),
        ])->where('kode_urusan', str($urusan)->replace('-', '.'))->first();
        // return $nomen;
        return view('referensi.nomenklatur.4-kegiatan', [
            'apps' => [
                'title' => 'Referensi',
                'desc' => 'REFERENSI NOMENKLATUR KEGIATAN',
            ],
            'nomen' => $nomen,
        ]);
    }

    function subkegiatan($urusan, $bidang, $program, $kegiatan)
    {
        $nomen = A1Urusan::with([
            'bidang' => fn ($q) => $q->where('kode_bidang', str($bidang)->replace('-', '.')),
            'bidang.program' => fn ($q) => $q->where('kode_program', str($program)->replace('-', '.')),
            'bidang.program.kegiatan' => fn ($q) => $q->where('kode_kegiatan', str($kegiatan)->replace('-', '.')),
        ])->where('kode_urusan', str($urusan)->replace('-', '.'))->first();
        return view('referensi.nomenklatur.5-subkegiatan', [
            'apps' => [
                'title' => 'Referensi',
                'desc' => 'REFERENSI NOMENKLATUR SUB KEGIATAN',
            ],
            'nomen' => $nomen,
        ]);
    }
}
