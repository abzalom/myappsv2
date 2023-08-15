<?php

namespace Database\Seeders;

use App\Models\PangkatPegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PangkatPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/referensi/pangkat.json'), true))->toArray();
        PangkatPegawai::truncate();
        foreach ($data as $query) {
            PangkatPegawai::create($query);
        }
    }
}
