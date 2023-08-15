<?php

namespace Database\Seeders;

use App\Models\D5RincianLo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class D5RincianLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/D5RincianLo.json'), true))->toArray();
        D5RincianLo::truncate();
        foreach ($data as $query) {
            D5RincianLo::create($query);
        }
    }
}
