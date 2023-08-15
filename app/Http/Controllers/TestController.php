<?php

namespace App\Http\Controllers;

use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use App\Models\Rkpd\Ranwal\Ranwal2Bidang;
use App\Models\Rkpd\Ranwal\Ranwal3Program;
use App\Models\Rkpd\Ranwal\Ranwal4Kegiatan;
use App\Models\Rkpd\Ranwal\Ranwal5Subkegiatan;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;
use App\Models\RpjmdPeriode;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $periode = RpjmdPeriode::find(1);
        $interval = $periode->akhir - $periode->awal;
        $data['tahuns'] = [];
        $data['aktif'] = [];

        for ($i = 0; $i <= (int) $interval; $i++) {
            $tahun = $periode->awal + $i;
            array_push(
                $data['tahuns'],
                $tahun
            );
            if ($tahun == session()->get('tahun')) {
                array_push(
                    $data['aktif'],
                    $tahun
                );
            }
        }
        session()->forget('periode');
        session()->put('periode', $data);
        return session()->all();
    }

    public function deleteRanwal()
    {
        Ranwal1Urusan::where('tahun', 2023)->forceDelete();
        Ranwal2Bidang::where('tahun', 2023)->forceDelete();
        Ranwal3Program::where('tahun', 2023)->forceDelete();
        Ranwal4Kegiatan::where('tahun', 2023)->forceDelete();
        Ranwal5Subkegiatan::where('tahun', 2023)->forceDelete();
        Ranwal6Subkeluaran::where('tahun', 2023)->forceDelete();
        return 'data ranwa tahun 2023 terhapus';
    }
}
