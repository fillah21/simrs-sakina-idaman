<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\Tindakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TindakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = Layanan::all();
        $id_layanan = $layanan->pluck('id')->toArray();

        $file_tindakan = public_path('json/tindakan.json');

        $json_tindakan = file_get_contents($file_tindakan);

        $data_tindakan = json_decode($json_tindakan, true);

        foreach($data_tindakan as $tindakan) {
            Tindakan::create([
                'layanan_id' => $id_layanan[$tindakan['layanan_id']],
                'kode_tindakan' => $tindakan['kode_tindakan'],
                'nama_tindakan' => $tindakan['nama_tindakan'],
                'harga_tindakan' => $tindakan['harga_tindakan'],
            ]);
        }

        echo "Tindakan Seeder Selesai \n";
    }
}
