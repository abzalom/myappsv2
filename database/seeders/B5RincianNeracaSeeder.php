<?php

namespace Database\Seeders;

use App\Models\B5RincianNeraca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class B5RincianNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/B5RincianNeraca.json'), true))->toArray();
        B5RincianNeraca::truncate();
        foreach ($data as $query) {
            B5RincianNeraca::create($query);
        }
    }
}
