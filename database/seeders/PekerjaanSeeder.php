<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_pekerjaan = public_path('json/pekerjaan.json');

        $json_pekerjaan = file_get_contents($file_pekerjaan);

        $data_pekerjaan = json_decode($json_pekerjaan, true);

        echo "Memulai proses seeder data Pekerjaan...\n";
        
        foreach ($data_pekerjaan as $pekerjaan) {
            Pekerjaan::create([
                'kode_pekerjaan' => $pekerjaan['kode_pekerjaan'],
                'nama_pekerjaan' => $pekerjaan['nama_pekerjaan']
            ]);
        }

        echo "Seeder Pekerjaan Selesai...\n";
    }
}
