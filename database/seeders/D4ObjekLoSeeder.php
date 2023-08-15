<?php

namespace Database\Seeders;

use App\Models\D4ObjekLo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class D4ObjekLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/D4ObjekLo.json'), true))->toArray();
        D4ObjekLo::truncate();
        foreach ($data as $query) {
            D4ObjekLo::create($query);
        }
    }
}
