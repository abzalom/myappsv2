<?php

namespace Database\Seeders;

use App\Models\A4Kegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class A4KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/nomens/kegiatan.json'), true))->unique('kode_kegiatan')->toArray();
        A4Kegiatan::truncate();
        foreach ($data as $query) {
            A4Kegiatan::create($query);
        }
    }
}
