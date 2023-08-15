<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\B2KelompokNeraca;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class B2KelompokNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/B2KelompokNeraca.json'), true))->toArray();
        B2KelompokNeraca::truncate();
        foreach ($data as $query) {
            B2KelompokNeraca::create($query);
        }
    }
}
