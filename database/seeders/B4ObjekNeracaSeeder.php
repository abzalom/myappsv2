<?php

namespace Database\Seeders;

use App\Models\B4ObjekNeraca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class B4ObjekNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/B4ObjekNeraca.json'), true))->toArray();
        B4ObjekNeraca::truncate();
        foreach ($data as $query) {
            B4ObjekNeraca::create($query);
        }
    }
}
