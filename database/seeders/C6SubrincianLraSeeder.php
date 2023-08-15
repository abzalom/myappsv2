<?php

namespace Database\Seeders;

use App\Models\C6SubrincianLra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class C6SubrincianLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/C6SubrincianLra.json'), true))->toArray();
        C6SubrincianLra::truncate();
        foreach ($data as $query) {
            C6SubrincianLra::create($query);
        }
    }
}
