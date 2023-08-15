<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JadwaHelper
{
    public static function rkpd($tahapan = null, $tahun = null)
    {
        $jadwal = DB::table('jadwal_rkpds')->where([
            'tahapan' => $tahapan,
            'tahun' => $tahun
        ])
            ->whereNull('deleted_at')->first();
        return $jadwal;
    }

    public static function countdown($tahapan = null, $tahun = null)
    {
        $jadwal = DB::table('jadwal_rkpds')->where([
            'tahapan' => $tahapan,
            'tahun' => $tahun
        ])
            ->whereNull('deleted_at')->first();

        if ($jadwal) {
            if (Carbon::parse($jadwal->mulai)->isPast()) {
                if (!Carbon::parse($jadwal->selesai)->isPast()) {
                    return 'sedang berlangsung selama : ' . str(Carbon::parse($jadwal->selesai)->diffForHumans(['parts' => 3]))->replace('dari sekarang', '');
                } else {
                    return 'sudah selesai';
                }
            } else {
                return 'segera dimulai dalam : ' . str(Carbon::parse($jadwal->mulai)->diffForHumans(['parts' => 2]))->replace('dari sekarang', '');
            }
        } else {
            return 'belum dibuat atau telah berakhir!';
        }
    }

    public static function lock($tahapan = null, $tahun = null): bool
    {
        $jadwal = DB::table('jadwal_rkpds')->where([
            'tahapan' => $tahapan,
            'tahun' => $tahun
        ])
            ->whereNull('deleted_at')->first();

        if ($jadwal) {
            if (Carbon::parse($jadwal->mulai)->isPast()) {
                if (!Carbon::parse($jadwal->selesai)->isPast()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
