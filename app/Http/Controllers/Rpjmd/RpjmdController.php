<?php

namespace App\Http\Controllers\Rpjmd;

use App\Http\Controllers\Controller;
use App\Http\Resources\PejabatSekdaCollection;
use App\Http\Resources\RpjmdCollection;
use App\Models\A3Program;
use App\Models\PejabatSekda;
use App\Models\RpjmdMisi;
use App\Models\RpjmdPeriode;
use App\Models\RpjmdTujuan;
use App\Models\RpjmdVisi;
use Illuminate\Http\Request;

class RpjmdController extends Controller
{
    public function periode(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $edit = RpjmdPeriode::find($request->edit);
        }
        return view('rpjmd.1-rpjmd-periode', [
            'apps' => [
                'title' => 'RPJMD',
                'desc' => 'PERIODE RPJMD',
            ],
            'periodes' => RpjmdPeriode::get(),
            'sekda' => PejabatSekda::where('active', true)->first(),
            'edit' => $edit,
        ]);
    }

    public function visi(Request $request)
    {
        $periode = RpjmdPeriode::where('active', true)->first();
        if (!$periode) {
            return redirect()->to(route('rpjmd.periode'))->with('pesan', 'Periode RPJMD belum di input atau belum diaktifkan');
        }
        $edit = false;
        if ($request->edit) {
            $edit = $periode->visis->where('id', $request->edit)->first();
            // $edit = RpjmdVisi::find($request->edit);
        }
        return view('rpjmd.2-rpjmd-visi', [
            'apps' => [
                'title' => 'RPJMD',
                'desc' => 'VISI PEMBANGUNAN RPJMD PRIODE ' . $periode->awal . ' - ' . $periode->akhir,
            ],
            'periode' => $periode,
            'edit' => $edit,
        ]);
    }

    function misi(Request $request)
    {
        $periode = RpjmdPeriode::where('active', true)->first();
        if (!$periode) {
            return redirect()->to(route('rpjmd.periode'))->with('pesan', 'Periode RPJMD belum di input atau belum diaktifkan');
        }
        if (count($periode->visis) == 0) {
            return redirect()->to(route('rpjmd.visi'))->with('pesan', 'Visi Kepala Daerah belum di input');
        }
        $edit = false;
        if ($request->edit) {
            $edit = RpjmdMisi::find($request->edit);
        }

        return view('rpjmd.3-rpjmd-misi', [
            'apps' => [
                'title' => 'RPJMD',
                'desc' => 'MISI PEMBANGUNAN RPJMD PRIODE ' . $periode->awal . ' - ' . $periode->akhir,
            ],
            'periode' => $periode,
            'edit' => $edit,
        ]);
    }

    function tujuan(Request $request)
    {
        $periode = RpjmdPeriode::where('active', true)->first();
        if (!$periode) {
            return redirect()->to(route('rpjmd.periode'))->with('pesan', 'Periode RPJMD belum di input atau belum diaktifkan');
        }
        if (count($periode->visis) == 0) {
            return redirect()->to(route('rpjmd.visi'))->with('pesan', 'Visi Kepala Daerah belum di input');
        }

        return view('rpjmd.4-rpjmd-tujuan', [
            'apps' => [
                'title' => 'RPJMD',
                'desc' => 'TUJUAN PEMBANGUNAN RPJMD PRIODE ' . $periode->awal . ' - ' . $periode->akhir,
            ],
            'periode' => $periode,
        ]);
    }

    public function sasaran()
    {
        $periode = RpjmdPeriode::where('active', true)->first();
        if (!$periode) {
            return redirect()->to(route('rpjmd.periode'))->with('pesan', 'Periode RPJMD belum di input atau belum diaktifkan');
        }
        if (count($periode->visis) == 0) {
            return redirect()->to(route('rpjmd.visi'))->with('pesan', 'Visi Kepala Daerah belum di input');
        }

        return view('rpjmd.5-rpjmd-sasaran', [
            'apps' => [
                'title' => 'RPJMD',
                'desc' => 'SASARAN PEMBANGUNAN RPJMD PRIODE ' . $periode->awal . ' - ' . $periode->akhir,
            ],
            'periode' => $periode,
        ]);
    }

    public function indikator()
    {
        $periode = RpjmdPeriode::where('active', true)->first();
        if (!$periode) {
            return redirect()->to(route('rpjmd.periode'))->with('pesan', 'Periode RPJMD belum di input atau belum diaktifkan');
        }
        if (count($periode->visis) == 0) {
            return redirect()->to(route('rpjmd.visi'))->with('pesan', 'Visi Kepala Daerah belum di input');
        }

        return view('rpjmd.6-rpjmd-indikator', [
            'apps' => [
                'title' => 'RPJMD',
                'desc' => 'INDIKATOR PEMBANGUNAN RPJMD PRIODE ' . $periode->awal . ' - ' . $periode->akhir,
            ],
            'periode' => $periode,
        ]);
    }

    public function program()
    {
        $periode = RpjmdPeriode::where('active', true)->first();
        if (!$periode) {
            return redirect()->to(route('rpjmd.periode'))->with('pesan', 'Periode RPJMD belum di input atau belum diaktifkan');
        }
        if (count($periode->visis) == 0) {
            return redirect()->to(route('rpjmd.visi'))->with('pesan', 'Visi Kepala Daerah belum di input');
        }

        return view('rpjmd.7-rpjmd-program', [
            'apps' => [
                'title' => 'RPJMD',
                'desc' => 'PROGRAM PEMBANGUNAN RPJMD PRIODE ' . $periode->awal . ' - ' . $periode->akhir,
            ],
            'periode' => $periode,
            'a3programs' => A3Program::all(),
        ]);
    }
}
