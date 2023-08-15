<?php

namespace Database\Seeders;

use App\Models\D1AkunLo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class D1AkunLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/D1AkunLo.json'), true))->toArray();
        D1AkunLo::truncate();
        foreach ($data as $query) {
            D1AkunLo::create($query);
        }
    }
}
