<?php

namespace App\Http\Controllers\Renstra;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\RpjmdPeriode;
use Illuminate\Http\Request;

class RenstraController extends Controller
{
    public function renstra()
    {
        $rpjmd = RpjmdPeriode::where('active', true)->first();
        // $awal = now()->format('Y');
        // return $awal;
        $awal = $rpjmd ? $rpjmd->awal : now()->format('Y');
        $akhir = $rpjmd ? $rpjmd->akhit : now()->format('Y') + 5;
        $desc_awal = $rpjmd ? $rpjmd->awal : now()->format('Y');
        $desc_akhir = $rpjmd ? $rpjmd->akhit : now()->format('Y') + 5;
        $interval = (int) $akhir - (int) $awal;
        // echo $interval;
        $tahuns = [];
        for ($i = 0; $i <= $interval; $i++) {
            array_push($tahuns, (int)$awal++);
        }
        return view('renstra.renstra-opd', [
            'apps' => [
                'title' => 'Renstra',
                'desc' => 'Renstra Perangkat Daerah Periode RPJMD ' . $desc_awal . ' - ' . $desc_akhir,
            ],
            'opds' => Opd::get(),
            'rpjmd' => $rpjmd,
            'tahuns' => $tahuns,
        ]);
    }

    public function renstrainput($opd)
    {
        $opd = Opd::find($opd);
        $rpjmd = RpjmdPeriode::where('active', true)->first();
        $awal = $rpjmd->awal;
        $interval = (int) $rpjmd->akhir - (int) $rpjmd->awal;
        // echo $interval;
        $tahuns = [];
        for ($i = 0; $i <= $interval; $i++) {
            array_push($tahuns, (int)$awal++);
        }
        return view('renstra.renstra-input-opd', [
            'apps' => [
                'title' => 'Renstra',
                'desc' => 'Renstra Perangkat Daerah ' .  ucwords($opd->nama_lower),
            ],
            'opd' => $opd,
            'rpjmd' => $rpjmd,
            'tahuns' => $tahuns,
        ]);
    }
}
