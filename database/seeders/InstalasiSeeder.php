<?php

namespace Database\Seeders;

use App\Models\Instalasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstalasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instalasi::create([
            'kode_instalasi' => 'INS001',
            'nama_instalasi' => 'RAWAT JALAN',
            'is_antrian' => true,
        ]);

        Instalasi::create([
            'kode_instalasi' => 'INS002',
            'nama_instalasi' => 'RAWAT INAP',
            'is_antrian' => true,
        ]);

        Instalasi::create([
            'kode_instalasi' => 'INS003',
            'nama_instalasi' => 'IGD',
            'is_antrian' => false,
        ]);

        echo "Instalasi Seeder Selesai \n";
    }
}
