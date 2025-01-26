<?php

namespace Database\Seeders;

use App\Models\Jaminan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JaminanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jaminan::create([
            'kode_jaminan' => 'JMN001',
            'nama_jaminan' => 'UMUM',
            'wajib_rujukan' => false,
            'wajib_keterangan_jaminan' => false
        ]);

        Jaminan::create([
            'kode_jaminan' => 'JMN002',
            'nama_jaminan' => 'BPJS',
            'wajib_rujukan' => true,
            'wajib_keterangan_jaminan' => true
        ]);

        Jaminan::create([
            'kode_jaminan' => 'JMN003',
            'nama_jaminan' => 'JAMINAN PERUSAHAAN',
            'wajib_rujukan' => true,
            'wajib_keterangan_jaminan' => true
        ]);

        Jaminan::create([
            'kode_jaminan' => 'JMN003',
            'nama_jaminan' => 'LAIN-LAIN',
            'wajib_rujukan' => true,
            'wajib_keterangan_jaminan' => true
        ]);

        echo "Jaminan Seeder Selesai \n";
    }
}
