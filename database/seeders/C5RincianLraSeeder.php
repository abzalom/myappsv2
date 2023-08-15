<?php

namespace Database\Seeders;

use App\Models\C5RincianLra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class C5RincianLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/C5RincianLra.json'), true))->toArray();
        C5RincianLra::truncate();
        foreach ($data as $query) {
            C5RincianLra::create($query);
        }
    }
}
