<?php

namespace Database\Seeders;

use App\Models\A1Urusan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class A1UrusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/nomens/urusan.json'), true))->toArray();
        A1Urusan::truncate();
        foreach ($data as $query) {
            A1Urusan::create($query);
        }
    }
}
