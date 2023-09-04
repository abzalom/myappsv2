<?php

namespace Database\Seeders;

use App\Models\Opd;
use App\Models\OpdTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('/data/backup/opds.json'), true))->toArray();
        Opd::truncate();
        OpdTag::truncate();
        foreach ($data as $query) {
            $opd = Opd::create([
                'kode_bidang' => $query['kode_bidang'],
                'nomor' => $query['nomor'],
                'kode_opd' => $query['kode_opd'],
                'nama_opd' => $query['nama_opd'],
                'tahun' => 2023
            ]);
            foreach ($query['tags'] as $tag) {
                OpdTag::create([
                    'kode_opd' => $opd->kode_opd,
                    'kode_urusan' => $tag['kode_urusan'],
                    'kode_bidang' => $tag['kode_bidang'],
                    'tahun' => 2023
                ]);
            }
        }
    }
}
