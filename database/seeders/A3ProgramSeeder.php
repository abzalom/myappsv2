<?php

namespace Database\Seeders;

use App\Models\A3Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class A3ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect(json_decode(Storage::disk('public')->get('data/nomens/program.json'), true))->toArray();
        A3Program::truncate();
        foreach ($data as $query) {
            A3Program::create($query);
        }
    }
}
