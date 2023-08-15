<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class JadwalRkpdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rkpd:jadwal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jalankan Jadwal Tahapan RKPD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tahun = DB::table('tahuns')->where('active', true)->first();
        $jadwal = DB::table('jadwal_rkpds')->where(['tahun' => $tahun->tahun, 'deleted_at' => null])->update([
            'keterangan' => 'update lagi',
        ]);
    }
}
