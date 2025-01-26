<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahIndonesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_prov = public_path('json/provinsi.json');
        $file_kab = public_path('json/kabupaten.json');
        $file_kec = public_path('json/kecamatan.json');
        $file_kel = public_path('json/kelurahan.json');

        $json_prov = file_get_contents($file_prov);
        $json_kab = file_get_contents($file_kab);
        $json_kec = file_get_contents($file_kec);
        $json_kel = file_get_contents($file_kel);

        $data_prov = json_decode($json_prov, true);
        $data_kab = json_decode($json_kab, true);
        $data_kec = json_decode($json_kec, true);
        $data_kel = json_decode($json_kel, true);

        echo "Memulai proses seeder data Provinsi...\n";
        foreach ($data_prov as $prov) {
            Provinsi::create($prov);
        }
        echo "Seeder Provinsi Selesai...\n";

        echo "Memulai proses seeder data Kabupaten...\n";
        foreach ($data_kab as $kab) {
            Kabupaten::create([
                'provinsi_id' => $kab['provinsi_id'],
                'kode_kabupaten' => $kab['kode_kabupaten'],
                'nama_kabupaten' => $kab['nama_kabupaten'],
                'tipe_kabupaten' => $kab['tipe_kabupaten'],
            ]);
        }
        echo "Seeder Kabupaten Selesai...\n";

        $chunk_kec = array_chunk($data_kec, 1000);
        foreach ($chunk_kec as $key => $chunk) {
            echo "Memulai proses seeder data Kecamatan... ke " . ($key + 1) . "000\n";
            foreach ($chunk as $kec) {
                Kecamatan::create([
                'kabupaten_id' => $kec['kabupaten_id'],
                'kode_kecamatan' => $kec['kode_kecamatan'],
                'nama_kecamatan' => $kec['nama_kecamatan'],
                ]);
            }
            echo "Seeder Kecamatan Selesai... ke " . ($key + 1) . "000\n";
        }

        $chunk_kel = array_chunk($data_kel, 1000);
        foreach ($chunk_kel as $key => $chunk) {
            echo "Memulai proses seeder data Kelurahan... ke " . ($key + 1) . "000\n";
            foreach ($chunk as $kel) {
                Kelurahan::create([
                    'kecamatan_id' => $kel['kecamatan_id'],
                    'kode_kelurahan' => $kel['kode_kelurahan'],
                    'nama_kelurahan' => $kel['nama_kelurahan'],
                    'kode_pos' => $kel['kode_pos'],
                ]);
            }
            echo "Seeder Kelurahan Selesai... ke " . ($key + 1) . "000\n";
        }
    }
}
