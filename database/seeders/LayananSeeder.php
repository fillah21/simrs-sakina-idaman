<?php

namespace Database\Seeders;

use App\Models\Instalasi;
use App\Models\Layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instalasi = Instalasi::all();

        $nama_instalasi = $instalasi->pluck('nama_instalasi')->toArray();
        $id_instalasi = $instalasi->pluck('id')->toArray();

        $file_layanan = public_path('json/layanan.json');

        $json_layanan = file_get_contents($file_layanan);

        $data_layanan = json_decode($json_layanan, true);

        foreach($data_layanan as $layanan) {
            $find_index = array_search($layanan['instalasi'], $nama_instalasi);
            
            if(is_int($find_index)) {
                Layanan::create([
                    'instalasi_id' => $id_instalasi[$find_index],
                    'kode_layanan' => $layanan['kode_layanan'],
                    'inisial_layanan' => $layanan['inisial_layanan'],
                    'nama_layanan' => $layanan['nama_layanan'],
                    'harga_layanan' => $layanan['harga_layanan'],
                    'wajib_rujukan' => $layanan['wajib_rujukan'],
                ]);
            }
        }

        echo "Layanan Seeder Selesai \n";
    }
}
