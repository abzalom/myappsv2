<?php

namespace Database\Seeders;

use App\Models\C2KelompokLra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class C2KelompokLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/C2KelompokLra.json'), true))->toArray();
        C2KelompokLra::truncate();
        foreach ($data as $query) {
            C2KelompokLra::create($query);
        }
    }
}
