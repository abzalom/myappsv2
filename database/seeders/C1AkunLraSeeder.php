<?php

namespace Database\Seeders;

use App\Models\C1AkunLra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class C1AkunLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/rekenings/C1AkunLra.json'), true))->toArray();
        C1AkunLra::truncate();
        foreach ($data as $query) {
            C1AkunLra::create($query);
        }
    }
}
