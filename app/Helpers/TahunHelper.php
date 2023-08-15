<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class TahunHelper
{
    public static function getTahunAktif()
    {
        $tahun = DB::table('tahuns')->where('active', true)->first();
        if ($tahun) {
            return $tahun->tahun;
        } else {
            return now()->format('Y');
        }
    }
}
