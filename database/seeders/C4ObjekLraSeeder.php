<?php

namespace Database\Seeders;

use App\Models\C4ObjekLra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class C4ObjekLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/C4ObjekLra.json'), true))->toArray();
        C4ObjekLra::truncate();
        foreach ($data as $query) {
            C4ObjekLra::create($query);
        }
    }
}
