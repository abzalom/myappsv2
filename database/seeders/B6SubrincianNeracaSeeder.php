<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\B6SubrincianNeraca;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class B6SubrincianNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/B6SubrincianNeraca.json'), true))->toArray();
        B6SubrincianNeraca::truncate();
        foreach ($data as $query) {
            B6SubrincianNeraca::create($query);
        }
    }
}
