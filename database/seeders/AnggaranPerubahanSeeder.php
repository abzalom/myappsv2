<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\PaguOpd\PaguPerubahanOpd;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnggaranPerubahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('/data/2023/pagu_ranwal_opds.json'), true))->toArray();
        PaguPerubahanOpd::truncate();
        foreach ($data as $query) {
            PaguPerubahanOpd::updateOrCreate(
                [
                    'kode_opd' => $query['kode_opd'],
                    'kode_sumberdana' => $query['kode_sumberdana'],
                    'kode_unik_sumberdana' => $query['kode_unik_sumberdana'],
                    'jumlah' => $query['jumlah'],
                    'menjadi_jumlah' => $query['jumlah'],
                    'tahun' => 2023,
                ]
            );
        }
        $data = collect(json_decode(Storage::disk('public')->get('data/2023/sumberdana_ranwal.json'), true))->toArray();
        SumberdanaPerubahan::truncate();
        foreach ($data as $query) {
            SumberdanaPerubahan::create($query);
        }
    }
}
