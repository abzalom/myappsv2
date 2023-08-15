<?php

namespace Database\Seeders;

use App\Models\A2Bidang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class A2BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/nomens/bidang.json'), true))->toArray();
        A2Bidang::truncate();
        foreach ($data as $query) {
            A2Bidang::create($query);
        }
    }
}
