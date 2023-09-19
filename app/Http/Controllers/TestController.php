<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\OpdTag;
use App\Models\PaguOpd\PaguPerubahanOpd;
use App\Models\Rkpd\Perubahan\Perubahan4Kegiatan;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use App\Models\Rkpd\Perubahan\Perubahan6Subkeluaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function testuser()
    {
        $opd = Opd::find(1);
        $paguopd = PaguPerubahanOpd::where(
            ['kode_opd' => $opd->kode_opd],
        )
            ->where(
                ['kode_unik_sumberdana' => '1.2.01.01.02-1'],
            )
            ->withSum(
                [
                    'menjadi_subkeluarans as total_subkel_per_sumberdana' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
                ],
                'menjadi_anggaran'
            )
            ->first();
        return $paguopd;
    }

    public function coba()
    {
        $opds = Opd::with('tags')->get();
        $datas = [];
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
        return ($datas);
    }

    public function RollbackPerubahan()
    {
        // Perubahan4Kegiatan::truncate();
        // Perubahan5Subkegiatan::truncate();
        // Perubahan6Subkeluaran::truncate();
        return 'data tahun 2023 terhapus';
    }
}
