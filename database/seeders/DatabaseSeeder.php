<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // RolesAndPermissionsSeeder::class,
            // MenuSeeder::class,
            // A1UrusanSeeder::class,
            // A2BidangSeeder::class,
            // A3ProgramSeeder::class,
            // A4KegiatanSeeder::class,
            // A5SubkegiatanSeeder::class,
            // B1AkunNeracaSeeder::class,
            // B2KelompokNeracaSeeder::class,
            // B3JenisNeracaSeeder::class,
            // B4ObjekNeracaSeeder::class,
            // B5RincianNeracaSeeder::class,
            // B6SubrincianNeracaSeeder::class,
            // C1AkunLraSeeder::class,
            // C2KelompokLraSeeder::class,
            // C3JenisLraSeeder::class,
            // C4ObjekLraSeeder::class,
            // C5RincianLraSeeder::class,
            // C6SubrincianLraSeeder::class,
            // D1AkunLoSeeder::class,
            // D2KelompokLoSeeder::class,
            // D3JenisLoSeeder::class,
            // D4ObjekLoSeeder::class,
            // D5RincianLoSeeder::class,
            // D6SubrincianLoSeeder::class,
        ]);
    }
}
