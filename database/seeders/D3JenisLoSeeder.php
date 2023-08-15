<?php

namespace Database\Seeders;

use App\Models\D3JenisLo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class D3JenisLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/D3JenisLo.json'), true))->toArray();
        D3JenisLo::truncate();
        foreach ($data as $query) {
            D3JenisLo::create($query);
        }
    }
}
