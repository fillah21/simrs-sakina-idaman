<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        ini_set('memory_limit', '-1');

        DB::beginTransaction();

        $this->call([
            UserSeeder::class,
            InstalasiSeeder::class,
            JaminanSeeder::class,
            AgamaSeeder::class,
            PekerjaanSeeder::class,
            PendidikanSeeder::class,
            WilayahIndonesiaSeeder::class,
            LayananSeeder::class,
            TindakanSeeder::class,
            DokterSeeder::class
        ]);

        DB::commit();

        echo "Seed selesai \n";
    }
}
