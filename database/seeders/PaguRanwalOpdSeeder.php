<?php

namespace Database\Seeders;

use App\Models\PaguRanwalOpd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\PaguOpd\PaguPerubahanOpd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaguRanwalOpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('/data/2023/pagu_ranwal_opds.json'), true))->toArray();
        PaguRanwalOpd::truncate();
        foreach ($data as $query) {
            PaguRanwalOpd::updateOrCreate(
                [
                    'kode_opd' => $query['kode_opd'],
                    'kode_sumberdana' => $query['kode_sumberdana'],
                    'kode_unik_sumberdana' => $query['kode_unik_sumberdana'],
                    'jumlah' => $query['jumlah'],
                    'tahun' => 2023,
                ]
            );
        }
    }
}
