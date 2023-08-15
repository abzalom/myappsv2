<?php

namespace Database\Seeders;

use App\Models\D2KelompokLo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class D2KelompokLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/D2KelompokLo.json'), true))->toArray();
        D2KelompokLo::truncate();
        foreach ($data as $query) {
            D2KelompokLo::create($query);
        }
    }
}
