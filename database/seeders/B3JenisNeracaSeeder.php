<?php

namespace Database\Seeders;

use App\Models\B3JenisNeraca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class B3JenisNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/B3JenisNeraca.json'), true))->toArray();
        B3JenisNeraca::truncate();
        foreach ($data as $query) {
            B3JenisNeraca::create($query);
        }
    }
}
