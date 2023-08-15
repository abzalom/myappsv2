<?php

namespace Database\Seeders;

use App\Models\Referensi\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'eselon 2a',
                'role' => 'eselon-2a',
            ],
            [
                'nama' => 'eselon 2b',
                'role' => 'eselon-2b',
            ],
            [
                'nama' => 'eselon 3a',
                'role' => 'eselon-3a',
            ],
            [
                'nama' => 'eselon 3b',
                'role' => 'eselon-3b',
            ],
            [
                'nama' => 'eselon 4a',
                'role' => 'eselon-4a',
            ],
            [
                'nama' => 'eselon 4b',
                'role' => 'eselon-4b',
            ],
            [
                'nama' => 'eselon 5a',
                'role' => 'eselon-5a',
            ],
        ];
        Jabatan::truncate();
        foreach ($data as $value) {
            Jabatan::create($value);
        }
    }
}
