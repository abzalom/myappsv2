<?php

namespace App\Http\Controllers\Perubahan\Anggaran;

use App\Models\Opd;
use App\Models\OpdPagu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaguOpd\PaguPerubahanOpd;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;

class PaguOpdPerubahanController extends Controller
{
    public function paguopd(Request $request)
    {
        $sumberdanaperubahan = SumberdanaPerubahan::get();
        $opds = Opd::with([
            'paguperubahans',
            'paguperubahans.sumberdana',
        ])->withSum('paguperubahans', 'jumlah')->orderBy('kode_opd')->get();
        $totalfilter = 0;
        if ($request->filter) {
            // return $request->all();
            $opds = Opd::with([
                'paguperubahans' => fn ($q) => $q->whereIn('kode_unik_sumberdana', $request->filter),
                'paguperubahans.sumberdana',
            ])
                ->withSum('paguperubahans', 'jumlah')
                ->orderBy('kode_opd')
                ->get();
            $totalfilter = PaguPerubahanOpd::whereIn('kode_unik_sumberdana', $request->filter)->sum('jumlah');
        }
        return view('anggaran.perubahan.perubahan-paguopd', [
            'apps' => [
                'title' => 'Pagu OPD',
                'desc' => 'perubahan Pagu OPD Tahun ' . tahun(),
            ],
            // 'editfilters' => $request->filter,
            'total' => PaguPerubahanOpd::whereHas('opd')->sum('jumlah'),
            'totalfilter' => $totalfilter,
            'opds' => $opds,
            'filters' => $sumberdanaperubahan,
            'pagutrashes' => PaguPerubahanOpd::onlyTrashed()->whereHas('opd')->orderBy('kode_opd')->get(),
        ]);
    }

    public function paguopdcetak(Request $request)
    {
        $opds = Opd::with('tags')->get();
        $datas = [];
        if (!$request->filter) {
            foreach ($opds as $opd) {
                $datas[$opd->id] = [];
                $datas[$opd->id] += [
                    'kode_opd' => $opd->kode_opd,
                    'nama_opd' => $opd->nama_opd,
                    'pagus' => [],
                ];
                foreach ($opd->tags as $tag) {
                    $pagu = PaguPerubahanOpd::withSum([
                        'menjadi_subkeluarans as gaji'  => fn ($q) => $q->where(['kode_opd' => $opd->kode_opd, 'kode_subkegiatan' => $tag->kode_bidang . '.01.2.02.01'])
                    ], 'menjadi_anggaran')
                        ->where('kode_opd', $opd->kode_opd)->get();
                    array_push($datas[$opd->id]['pagus'], $pagu->toArray());
                }
            }
            $sumberdanas = SumberdanaPerubahan::with([
                'sumberdana'
            ])->get();
        } else {
            foreach ($opds as $opd) {
                $datas[$opd->id] = [];
                $datas[$opd->id] += [
                    'kode_opd' => $opd->kode_opd,
                    'nama_opd' => $opd->nama_opd,
                    'pagus' => [],
                ];
                foreach ($opd->tags as $tag) {
                    $pagu = PaguPerubahanOpd::withSum([
                        'menjadi_subkeluarans as gaji'  => fn ($q) => $q->where(['kode_opd' => $opd->kode_opd, 'kode_subkegiatan' => $tag->kode_bidang . '.01.2.02.01'])
                    ], 'menjadi_anggaran')
                        ->where('kode_opd', $opd->kode_opd)
                        ->whereIn('kode_unik_sumberdana', $request->filter)
                        ->get();
                    array_push($datas[$opd->id]['pagus'], $pagu->toArray());
                }
            }
            $sumberdanas = SumberdanaPerubahan::with([
                'sumberdana'
            ])->whereIn('kode_unik', $request->filter)->get();
        }
        // return $datas;
        return view('anggaran.perubahan.perubahan-paguopd-cetak', [
            'opds' => $datas,
            'sumberdanas' => $sumberdanas,
        ]);
    }
}
