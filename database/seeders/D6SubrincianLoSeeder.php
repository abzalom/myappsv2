<?php

namespace Database\Seeders;

use App\Models\D6SubrincianLo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class D6SubrincianLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/D6SubrincianLo.json'), true))->toArray();
        D6SubrincianLo::truncate();
        foreach ($data as $query) {
            D6SubrincianLo::create($query);
        }
    }
}
