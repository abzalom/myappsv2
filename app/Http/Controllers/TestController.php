<?php

namespace App\Http\Controllers;

use App\Models\PaguRanwalOpd;
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
        $total_pages = 245;
        for ($i = 193; $i <= $total_pages; $i++) {
            if ($i % 2 !== 0) {
                echo $i, ',';
            }
        }
    }

    public function deleteRanwal()
    {
        // PaguRanwalOpd::truncate();
        Ranwal1Urusan::truncate();
        Ranwal2Bidang::truncate();
        Ranwal3Program::truncate();
        Ranwal4Kegiatan::truncate();
        Ranwal5Subkegiatan::truncate();
        Ranwal6Subkeluaran::truncate();
        return 'data tahun 2023 terhapus';
    }
}
