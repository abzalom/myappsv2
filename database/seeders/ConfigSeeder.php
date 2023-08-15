<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahuns')->truncate();
        DB::table('tahuns')->insert([
            'tahun' => '2023',
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
