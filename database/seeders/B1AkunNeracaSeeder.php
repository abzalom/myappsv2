<?php

namespace Database\Seeders;

use App\Models\B1AkunNeraca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class B1AkunNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/B1AkunNeraca.json'), true))->toArray();
        B1AkunNeraca::truncate();
        foreach ($data as $query) {
            B1AkunNeraca::create($query);
        }
    }
}
