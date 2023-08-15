<?php

namespace Database\Seeders;

use App\Models\C3JenisLra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class C3JenisLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/C3JenisLra.json'), true))->toArray();
        C3JenisLra::truncate();
        foreach ($data as $query) {
            C3JenisLra::create($query);
        }
    }
}
