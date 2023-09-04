<?php

namespace Database\Seeders;

use App\Models\SumberDana;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SumberdanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/referensi/sumberdana.json'), true))->toArray();
        SumberDana::truncate();
        foreach ($data as $query) {
            SumberDana::create($query);
        }
    }
}
