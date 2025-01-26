<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = Layanan::all();
        $id_layanan = $layanan->pluck('id')->toArray();

        $faker = Faker::create();

        $file_dokter = public_path('json/dokter.json');

        $json_dokter = file_get_contents($file_dokter);

        $data_dokter = json_decode($json_dokter, true);

        foreach($data_dokter as $dokter) {
            Dokter::create([
                'layanan_id' => $id_layanan[$dokter['layanan_id']],
                "kode_dokter" => $dokter['kode_dokter'],
                "nama_dokter" => $dokter['nama_dokter'],
                "sip" => strtoupper($faker->unique()->bothify('SIP###')),
                "hari_praktek" => $dokter['hari_praktek'],
                "jam_praktek" => $dokter['jam_praktek']
            ]);
        }

        echo "Dokter Seeder Selesai \n";
    }
}
