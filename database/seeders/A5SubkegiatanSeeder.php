<?php

namespace Database\Seeders;

use App\Models\A5Subkegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class A5SubkegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/backup/backup_subkegiatan_update_kinerja.json'), true))->toArray();
        A5Subkegiatan::truncate();
        foreach ($data as $query) {
            A5Subkegiatan::create($query);
        }
    }
}
