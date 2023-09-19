<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SumberdanaRanwal;
use App\Models\Sumberpendanaan\SumberdanaPerubahan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SumberdanaRanwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/2023/sumberdana_ranwal.json'), true))->toArray();
        SumberdanaRanwal::truncate();
        foreach ($data as $query) {
            SumberdanaRanwal::create($query);
        }
    }
}
